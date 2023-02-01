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

	public function get_formulasi($year, $indicator_id, $entry, $data_id){

		// get min max from first data
		$query = $this->db->select('MIN(data1) as min_val, MAX(data1) as max_val, AVG(data1) as med_val, indicator_type_value ')
					->join('ipkn_mst_indicator','ipkn_mst_indicator.indicator_id=ipkn_tr_data.indicator_id','left')
					->where('dh_id IN (select dh_id from ipkn_tr_data_header where dh_year = '.$year.') AND value > 0 AND ipkn_tr_data.indicator_id = '.$indicator_id.'')
					->get('ipkn_tr_data')->row();

		// define min max and med
        $min = $query->min_val;
        $max = $query->max_val;
        $med = $query->max_val - $query->min_val;
        $value = $entry;

		$exc_score = ($query->indicator_type_value == 'negatif') ? (7-6*(($value-$min)/$med)) : (6*(($value-$min)/$med)+1);
		$score = ($exc_score > 0)?$exc_score: 0;

		// update all score and meta data
		$meta_dt = $this->db
						->join('ipkn_mst_indicator','ipkn_mst_indicator.indicator_id=ipkn_tr_data.indicator_id','left')
						->where('dh_id IN (select dh_id from ipkn_tr_data_header where dh_year = '.$year.') AND ipkn_tr_data.indicator_id = '.$indicator_id.'')
						->get('ipkn_tr_data')->result();

		foreach ($meta_dt as $key => $row) {
			# code...
			$curr_value = $row->value;
			$exc_score = ($row->indicator_type_value == 'negatif') ? (7-6*(($curr_value-$min)/$med)) : (6*(($curr_value-$min)/$med)+1);
			$score_dt = ($exc_score > 0)?$exc_score: 0;
			$data_score1[] = array(
				'data_id' => $row->data_id,
				'value' => $row->value,
				'data1' => $row->value,
				'score1' => round($score_dt, 2),
				'min' => $min,
				'med' => $med,
				'max' => $max,
			);
		} 
		$this->db->update_batch('ipkn_tr_data', $data_score1, 'data_id'); 

		// get skor 2
		$next_skor = $this->countFunction2($data_score1, $data_id, $query->indicator_type_value);
		// echo '<pre>'; print_r($data2[$data_id]);die;
		
		
		// uupdate master indikator
		$this->db->where('indicator_id', $indicator_id)->update('ipkn_mst_indicator', array('indicator_min_value' => $min, 'indicator_max_value' => $max, 'indicator_med_value' => $med) );
		$return = array(
			'min' => $min,
			'med' => $med,
			'max' => $max,
			'score1' => round($score, 2),
			'score2' => round($next_skor['data2']['score2'], 2),
			'score3' => round($next_skor['data3']['score3'], 2),
			'score4' => round($next_skor['data4']['score4'], 2),
			'score5' => round($next_skor['data5']['score5'], 2),
			'score' => round($next_skor['data5']['score5'], 2),
		);
		return $return;
	}

	public function countFunction2($data, $data_id, $type){

		// data 2
		foreach ($data as $key => $row) {
			if($row['med'] > 1000){
				if($row['value'] > 0){
					// log
					$data2 = log($row['value']);
				}else{
					$data2 = 0;
				}
			}else{
				$data2 = $row['value'];
			}
			$getData[] = $data2;
			$getDataRow[$row['data_id']] = $data2;
		}

		sort($getData);
		$min = min($getData);
		$max = max($getData);
		$rentang = $max - $min;
		// skor 2
		$skor = [];
		foreach ($data as $key => $row) {
			# code...
			$skor = 6 * (($getDataRow[$row['data_id']] - $min)/$rentang) + 1;
			$skor = ($skor) ? $skor : 0;

			$data_score2[] = array(
				'data_id' => $row['data_id'],
				'data2' => $getDataRow[$row['data_id']],
				'score2' => round($skor, 2),
			);
			$data2_row[$row['data_id']] = array(
				'data2' => $getDataRow[$row['data_id']],
				'score2' => round($skor, 2),
			);
		}
		
		$this->db->update_batch('ipkn_tr_data', $data_score2, 'data_id'); 

		// skor 3
		// relation to third formulation
		foreach ($data_score2 as $key => $value) {
			$round = round($value['score2']);
			$count_value[$round][] = 1;
		}
		for ($i=1; $i < 8; $i++) { 
			$count_num[$i] = isset($count_value[$i]) ? count($count_value[$i]) : 0;
			if($i > 2){
				$for_sum[] = isset($count_value[$i]) ? count($count_value[$i]) : 0;
			}
		}
		// get small n
		$small = $getData[$count_num[1]];
		
		foreach ($data_score2 as $key => $value) {
			# code...
			if( ($count_num[2] == 0) && ($count_num[1] <= array_sum($for_sum)) ){
				$skor3 = 5 * ( ($value['data2']-$small) / ($max-$small) ) + 2;
			}else{
				$skor3 = $value['score2'];
			}

			$getScore3[$value['data_id']] = $skor3;

			$data_score3[] = array(
				'data_id' => $value['data_id'],
				'data3' => $getDataRow[$value['data_id']],
				'score3' => round($skor3, 2),
			);

			$data3_row[$value['data_id']] = array(
				'data3' => $getDataRow[$value['data_id']],
				'score3' => round($skor3, 2),
			);

		}

		$this->db->update_batch('ipkn_tr_data', $data_score3, 'data_id'); 


		// skor 4
		// relation to fourth formulation
		foreach ($data_score3 as $key => $value) {
			$round = round($value['score3']);
			$count_value[$round][] = 1;
		}
		for ($i=1; $i < 8; $i++) { 
			$count_num[$i] = isset($count_value[$i]) ? count($count_value[$i]) : 0;
			if($i > 2){
				$for_sum[] = isset($count_value[$i]) ? count($count_value[$i]) : 0;
			}
		}
		// get large
		rsort($getData);
		$large = $getData[$count_num[7]];

		foreach ($data_score3 as $key => $value) {
			# code...
			if( ($value['data3'] > $large)){
				$skor4 = 7;
			}else{
				if( $count_num[6] == 0){
					$skor4 = 5 * ( ($value['data3']-$min) / ($large-$min) ) + 1;
				}else{
					$skor4 = $value['score3'];
				}
				
			}

			$getScore4[$value['data_id']] = $skor4;

			$data_score4[] = array(
				'data_id' => $value['data_id'],
				'data4' => $getDataRow[$value['data_id']],
				'score4' => round($skor4, 2),
			);

			$data4_row[$value['data_id']] = array(
				'data4' => $getDataRow[$value['data_id']],
				'score4' => round($skor4, 2),
			);

		}

		$this->db->update_batch('ipkn_tr_data', $data_score4, 'data_id'); 

		// skor 5
		foreach ($data_score4 as $key => $value) {
			# code...
			if( ($type == 'negatif') ){
				$skor5 = 8-$value['score4'];
			}else{
				$skor5 = $value['score4'];
			}

			$getScore5[$value['data_id']] = $skor5;

			$data_score5[] = array(
				'data_id' => $value['data_id'],
				'data5' => $getDataRow[$value['data_id']],
				'score5' => round($skor5, 2),
				'score' => round($skor5, 2),
			);

			$data5_row[$value['data_id']] = array(
				'data5' => $getDataRow[$value['data_id']],
				'score5' => round($skor5, 2),
			);

		}

		$this->db->update_batch('ipkn_tr_data', $data_score5, 'data_id'); 

		$return = array(
			'data2' => $data2_row[$data_id],
			'data3' => $data3_row[$data_id],
			'data4' => $data4_row[$data_id],
			'data5' => $data5_row[$data_id],
		);
		// echo '<pre>'; print_r($return);die;
		
		return $return;

	}


}
