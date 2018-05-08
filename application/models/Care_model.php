<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Care_model extends CI_Model{
	public function incoming($data){
		$r = $this->db->insert('incoming',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function outgoing($data){
		$r = $this->db->insert('outgoing',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	public function select_tag(){
		$this->db->select('*');
		$this->db->from('taggingtree');
		$get = $this->db->get();
		return $get->result();
	}
	
	public function select_region(){
		$this->db->select('*');
		$this->db->from('region');
		$get = $this->db->get();
		return $get->result();
	}
	
	public function select(){
		$if_is = array(
			'show_row' => 0
		);
		$this->db->select('*');
		$this->db->from('row_data');
		$this->db->where($if_is);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function submit_error($data){
		$this->db->insert('queries',$data);
		if($this->db->affected_rows() <= 0){
			return false;
		}else{
			return true;
		}
	}

	public function paying($data){
		$r = $this->db->insert('waiting',$data);
	}
	public function select_by_date($agent,$date){
		$where_data = array(
				'DATE(date)' => $date,
				'agent' => $agent
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		return $rem;
	}

	public function select_waiting($state){
		$waiting = array(
			'paying <=' => date('Y-m-d H:i:s'),
			'type' => $state
			);
		$this->db->select('*');
		$this->db->where($waiting);
		$d = $this->db->get('waiting');
		return $d->result();
	}
}