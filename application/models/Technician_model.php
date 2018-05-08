<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Technician_model extends CI_Model{
	public function select($status){
		$select = array(
			'status' => $status
		);
		
		$this->db->select('*');
		$this->db->where($select);
		$res = $this->db->get('queries');
		return $res->result();
	}
}