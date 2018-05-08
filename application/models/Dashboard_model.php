<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	public function today_incoming(){
		$select =   array(
                'count(id) as total'
            );  
			
			$todaysDate = date("Y-m-d");
		
		$where_data = array(
				'DATE(care_time)' => $todaysDate
		);
		$this->db->select($select);
		$this->db->from('incoming');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		
		return $rem;
	}
	

	public function today_outgoing(){
		$select =   array(
                'count(outgoing.id) as total'
            );  
			
			$todaysDate = date("Y-m-d");
		
		$where_data = array(
				'DATE(date)' => $todaysDate
		);
		$this->db->select($select);
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		
		return $rem;
	}

	public function month_incoming(){
		$select =   array(
                'count(id) as total'
            );  
			
			$todaysDate = date("Y");
			$todaysDate1 = date("m");
		
		$where_data = array(
				'MONTH(care_time)' => $todaysDate1,
				'YEAR(care_time)' => $todaysDate
		);
		$this->db->select($select);
		$this->db->from('incoming');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		
		return $rem;
	}

	public function month_outgoing(){
		$select =   array(
                'count(outgoing.id) as total'
            );  
			
			$todaysDate = date("Y");
			$todaysDate1 = date("m");
		
		$where_data = array(
				'MONTH(date)' => $todaysDate1,
				'YEAR(date)' => $todaysDate
		);
		$this->db->select($select);
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		
		return $rem;
	}

	public function year_incoming(){
		$select =   array(
                'count(id) as total'
            );  
			
			$todaysDate = date("Y");
		
		$where_data = array(
				'YEAR(care_time)' => $todaysDate
		);
		$this->db->select($select);
		$this->db->from('incoming');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		
		return $rem;
	}

	public function year_outgoing(){
		$select =   array(
                'count(outgoing.id) as total'
            );  
			
			$todaysDate = date("Y");
		
		$where_data = array(
				'YEAR(date)' => $todaysDate
		);
		$this->db->select($select);
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		
		return $rem;
	}

	public function view_agent(){
		$this->db->select('*');
		$this->db->from('usertable');
		$q = $this->db->get();
		return $q->result();
	}

	public function view_agent2(){
		$select =   array(
                'usertable.fullname',
				'usertable.username',
                'count(outgoing.id) as total'
            );  
			
			$todaysDate = date("Y-m-d");
		
		$where_data = array(
				'DATE(date)' => $todaysDate
		);
		$this->db->select($select);
		$this->db->from('usertable');
		$this->db->join('outgoing','usertable.username = outgoing.agent');
		$this->db->where($where_data);
		$this->db->group_by('usertable.username');
		$rem = $this->db->get();
		$rem = $rem->result();
		
		return $rem;
	}
	
	public function problem($state){
		$select =   array(
                'count(ticketId) as total'
            );  
			
		
		$where_data = array(
				'status' => $state
		);
		$this->db->select($select);
		$this->db->from('queries');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		return $rem;
	}
}
?>