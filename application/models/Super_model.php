<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super_model extends CI_Model{
	
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

	public function count_time($data){
		$select = array(
			'TIMESTAMPDIFF(hour,startcall,date) as duration'
		);
		$this->db->select($select);
		$i = $this->db->get('incoming');
		$i->result();
	}
	public function selection_day(){
		$select =   array(
                'usertable.fullname',
				'usertable.username',
                'count(outgoing.id) as total',
				'SUM(TIMESTAMPDIFF(minute,outgoing.startcall,outgoing.date)) as duration'
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
	//graph reports
	public function select_by_datey($agent,$date){
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
	public function select_by_datem($agent,$month,$year){
		$where_data = array(
				'month(date)' => $month,
				'year(date)' => $year,
				'agent' => $agent
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		return $rem;
	}
	public function select_by_dateya($agent,$date){
		$where_data = array(
				'YEAR(date)' => $date,
				'agent' => $agent
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		return $rem;
	}
	//end here
	public function select_by_date2($agent,$date,$dateto){
		$where_data = array(
				'between DATE(date)' => $date,
				'DATE(date)' => $dateto,
				'agent' => $agent
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		$rem = $rem->result();
		return $rem;
	}
	public function select_by_date_e($agent,$date){
		$where_data = array(
				'DATE(date)' => $date,
				'agent' => $agent
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$rem = $this->db->get();
		//$rem = $rem->result();
		return $rem;
	}
	
	public function selection_month(){
		$select =   array(
                'usertable.fullname',
				'usertable.username',
                'count(outgoing.id) as total'
            );  
			
			$month = date("m");
			$year = date("Y");
		
		$where_data = array(
				'MONTH(date)' => $month,
				'YEAR(date)' => $year
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
	
	public function selection_year(){
		$select =   array(
                'usertable.fullname',
				'usertable.username',
                'count(outgoing.id) as total'
            );  
			$year = date("Y");
		
		$where_data = array(
				'YEAR(date)' => $year
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
	
	//Number of rows in record
	public function number(){
		$todaysDate = date("Y-m-d");
		$where_data = array(
				'DATE(date)' => $todaysDate
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$n = $this->db->get();
		$n = $n->num_rows();
		return $n;
	}
	
	public function number_month(){
		$month = date("m");
		$year = date("Y");
		
		$where_data = array(
				'MONTH(date)' => $month,
				'YEAR(date)' => $year
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$n = $this->db->get();
		$n = $n->num_rows();
		return $n;
	}
	
	public function number_year(){
		$year = date("Y");
		
		$where_data = array(
				'YEAR(date)' => $year
		);
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($where_data);
		$n = $this->db->get();
		$n = $n->num_rows();
		return $n;
	}
	
	//agent selection
	public function select_agent(){
		$where_data = array(
				'role' => 'Agent'
		);
		$this->db->select('*');
		$this->db->from('usertable');
		$this->db->where($where_data);
		$num = $this->db->get();
		return $num->result();
	}
	
	public function select_agent_by($agent){
		$where_data = array(
				'username' => $agent
		);
		$this->db->select('*');
		$this->db->from('usertable');
		$this->db->where($where_data);
		$num = $this->db->get();
		return $num->result();
	}
	
	
	///Report
	public function report_out($data_where){
		$this->db->select('*');
		$this->db->from('outgoing');
		$this->db->where($data_where);
		$rem = $this->db->get();
		return $rem->result();
	}
}