<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_input_dt_model extends CI_Model {

	var $table = 'ipkn_tr_data';
	var $column = array('ipkn_tr_data.value','ipkn_tr_data.updated_date','ipkn_tr_data.created_date');
	var $select = 'ipkn_tr_data.*, ipkn_mst_indicator.indicator_name, mst_provinces.name, ipkn_mst_indicator.indicator_name, ipkn_mst_indicator.indicator_code';

	var $order = array('ipkn_tr_data.data_id' => 'DESC', 'ipkn_tr_data.updated_date' => 'DESC');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _main_query(){
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('ipkn_mst_indicator',$this->table.'.indicator_id=ipkn_mst_indicator.indicator_id','left');
		$this->db->join('ipkn_mst_pillar','ipkn_mst_indicator.pillar_id=ipkn_mst_pillar.pillar_id','left');
		$this->db->join('mst_provinces','mst_provinces.id=ipkn_tr_data.province_id','left');

	}

	private function _get_datatables_query()
	{
		
		$this->_main_query();

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->_main_query();
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->_main_query();
		if(is_array($id)){
			$this->db->where_in(''.$this->table.'.data_id',$id);
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->where(''.$this->table.'.data_id',$id);
			$query = $this->db->get();
			return $query->row();
		}
		
	}

	public function get_by_dh_id($id)
	{
		$this->_main_query();
		$this->db->where(''.$this->table.'.dh_id', $id);
		$query = $this->db->get();
		return $query->result();		
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$get_data = $this->get_by_id($id);
		$this->db->where_in(''.$this->table.'.data_id', $id);
		return $this->db->update($this->table, array('is_deleted' => 'Y', 'is_active' => 'N'));
	}

	public function getLastDataInputed($dh_id){
		$exc_qry = $this->db->join('ipkn_mst_indicator','ipkn_mst_indicator.indicator_id=ipkn_tr_data.indicator_id','left')->get_where('ipkn_tr_data', array('dh_id' => $dh_id))->result();
		$getData = array();
		foreach($exc_qry as $row){
			$getData[$row->pillar_id][$row->indicator_id][] = $row;
		}
		return $getData;
	}

	public function getSubpillarActive($dh_id){
		$query = "SELECT b.*, c.pillar_desc FROM  ipkn_mst_indicator b, mst_pillar c WHERE b.pillar_id=c.pillar_id AND b.kl_id in (SELECT kl_id FROM ipkn_tr_data_header WHERE dh_id=".$dh_id.") AND b.is_active='Y'";
		$exc_qry = $this->db->query($query)->result();
		return $exc_qry;
	}

	public function get_formulasi($year, $indicator_id, $entry){

		$query = $this->db->select('MIN(data1) as min_val, MAX(data1) as max_val, AVG(data1) as med_val, indicator_type_value ')
					->join('ipkn_mst_indicator','ipkn_mst_indicator.indicator_id=ipkn_tr_data.indicator_id','left')
					->where('dh_id IN (select dh_id from ipkn_tr_data_header where dh_year = '.$year.') AND value > 0 AND ipkn_tr_data.indicator_id = '.$indicator_id.'')
					->get('ipkn_tr_data')->row();

		// get formulasi
        $min = $query->min_val;
        $max = $query->max_val;
        $med = $query->max_val - $query->min_val;
        $value = $entry;
		$exc_score = ($query->indicator_type_value == 'negatif') ? (7-6*(($value-$min)/$med)) : (6*(($value-$min)/$med)+1);
		$score = ($exc_score > 0)?$exc_score: 0;

		// update score and meta data
		$meta_dt = $this->db
						->join('ipkn_mst_indicator','ipkn_mst_indicator.indicator_id=ipkn_tr_data.indicator_id','left')
						->where('dh_id IN (select dh_id from ipkn_tr_data_header where dh_year = '.$year.') AND ipkn_tr_data.indicator_id = '.$indicator_id.'')
						->get('ipkn_tr_data')->result();

		foreach ($meta_dt as $key => $row) {
			# code...
			$curr_value = $row->value;
			$exc_score = ($row->indicator_type_value == 'negatif') ? (7-6*(($curr_value-$min)/$med)) : (6*(($curr_value-$min)/$med)+1);

			$score_dt = ($exc_score > 0)?$exc_score: 0;
			$data_update[] = array(
				'data_id' => $row->data_id,
				'value' => $row->value,
				'data1' => $row->value,
				'score1' => round($score_dt, 2),
				'min' => $min,
				'med' => $med,
				'max' => $max,
			);
		} 
		$this->db->update_batch('ipkn_tr_data', $data_update, 'data_id'); 
		
		// uupdate master indikator
		$this->db->where('indicator_id', $indicator_id)->update('ipkn_mst_indicator', array('indicator_min_value' => $min, 'indicator_max_value' => $max, 'indicator_med_value' => $med) );
		$return = array(
			'min' => $min,
			'med' => $med,
			'max' => $max,
			'score' => round($score, 2),
		);
		return $return;
	}


}
