<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mst_subpillar_model extends CI_Model {

	var $table = 'mst_subpillar';
	var $column = array('mst_subpillar.subpillar_desc', 'mst_kl.kl_short_name', 'mst_kl.kl_name','mst_pillar.pillar_desc');
	var $select = 'mst_subpillar.*, mst_kl.kl_short_name, mst_pillar.pillar_desc';

	var $order = array('mst_subpillar.subpillar_id' => 'DESC', 'mst_subpillar.updated_date' => 'DESC');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _main_query(){
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('mst_kl','mst_kl.kl_id='.$this->table.'.kl_id','left');
		$this->db->join('mst_pillar','mst_pillar.pillar_id='.$this->table.'.pillar_id','left');
		$this->db->where($this->table.".is_deleted != 'Y'");
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
		
		$this->db->where_in('tr_data.subpillar_id', $id);
		$this->db->delete('tr_data');

		$this->db->where_in(''.$this->table.'.subpillar_id', $id);
		return $this->db->delete($this->table);
	}


}
