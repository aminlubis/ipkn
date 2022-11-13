<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_summary_dt_public_model extends CI_Model {

	var $table = 'mst_subpillar';
	var $column = array('tr_data.value','tr_data.updated_date','tr_data.created_date');
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
		$this->db->where("mst_subpillar.is_deleted != 'Y'");
		// $this->db->where("tr_data.year", date('Y'));

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

}
