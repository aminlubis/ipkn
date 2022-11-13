<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_summary_dt_model extends CI_Model {

	var $table = 'mst_subpillar';
	var $column = array('tr_data.updated_date','tr_data.created_date');
	var $select = 'tr_data.*, mst_subpillar.subpillar_desc, mst_kl.kl_name, mst_pillar.pillar_desc, mst_kl.kl_short_name, mst_subpillar.data_value, mst_subpillar.subpillar_id';

	var $order = array('mst_subpillar.subpillar_id' => 'DESC', 'tr_data.updated_date' => 'DESC');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _main_query(){
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('tr_data',$this->table.'.subpillar_id=tr_data.subpillar_id','left');
		$this->db->join('mst_pillar', $this->table.'.pillar_id=mst_pillar.pillar_id','left');
		$this->db->join('mst_kl','mst_subpillar.kl_id=mst_kl.kl_id','left');
		$this->db->where($this->table.".is_deleted != 'Y'");
		if($this->session->userdata('user')->role != 1){
			$this->db->where($this->table.".kl_id", $this->session->userdata('user')->kl_id);
		}
		/*check level user*/
		$this->authuser->filtering_data_by_level_user($this->table, $this->session->userdata('user')->user_id);

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
		// print_r($this->db->last_query());die;
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
			$this->db->where_in(''.$this->table.'.subpillar_id',$id);
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->where(''.$this->table.'.subpillar_id',$id);
			$query = $this->db->get();
			return $query->row();
		}
		
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

	public function getMasterHeader(){
		$this->db->select('ipkn_mst_indicator.*, ipkn_mst_pillar.pillar_desc, ipkn_mst_subindex.index_desc');
		$this->db->from('ipkn_mst_indicator');
		$this->db->join('ipkn_mst_pillar', 'ipkn_mst_pillar.pillar_id=ipkn_mst_indicator.pillar_id','left');
		$this->db->join('ipkn_mst_subindex', 'ipkn_mst_subindex.index_id=ipkn_mst_pillar.index_id','left');
		$result = $this->db->get()->result();
		foreach ($result as $key => $value) {
			# code...
			$getData[$value->index_desc][$value->pillar_desc][] = $value;
		}
		return $getData;
	}

	public function getSummary(){
		$this->db->select('ipkn_tr_data.*');
		$this->db->from('ipkn_tr_data');
		$this->db->join('ipkn_tr_data_header', 'ipkn_tr_data_header.dh_id=ipkn_tr_data.dh_id', 'left');
		$result = $this->db->get()->result();
		foreach ($result as $key => $value) {
			$getData[$value->province_id][$value->indicator_id] = $value;
		}
		return $getData;
	}


}
