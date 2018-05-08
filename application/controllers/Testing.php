<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {
		public function sub(){
			$data['tittle'] = "hey";
			
			$this->load->model('Super_model','super');
			$myage = $data['view_agents'] = $this->super->select_agent();
			$data['view_selected_agent'] = "no agents";
			if($myage)
			$data['view_selected_agent'] = $myage[0]->username;
			$this->load->view('temp/heading.php',$data);
			$this->load->view('temp/sorting_form.php');
		}
		
		public function display(){
			$what = urldecode($this->uri->segment(3));
			$this->load->model('Super_model','super');
			$d1 = $d2 = $d3 = "";
			if($what == 1){
				$d1 = $this->input->post('search_date');
				$data_where = array(
					'DATE(date)' => $d1
				);
			}else if($what == 2){
				$d1 = $this->input->post('search_agent');
				$data_where = array(
					'agent' => $d1
				);
			}else if($what == 3){
				$d1 = $this->input->post('search_from');
				$d2 = $this->input->post('search_to');
				$data_where = array(
					'DATE(date) >=' => $d1,
					'DATE(date) <=' => $d2
				);
			}else if($what == 4){
				$d1 = $this->input->post('search_agent');
				$d2 = $this->input->post('search_time');
				$data_where = array(
					'agent' => $d1,
					'DATE(date)' => $d2
				);
			}else if($what == 5){
				$d1 = $this->input->post('search_agent');
				$d2 = $this->input->post('search_from');
				$d3 = $this->input->post('search_to');
				$data_where = array(
					'agent' => $d1,
					'DATE(date) >=' => $d2,
					'DATE(date) <=' => $d3
				);
			}
			
			$data['download_link'] = base_url('supervisor/download_excel/'.$what.'/'.$d1.'/'.$d2.'/'.$d3);
			$data['view_report'] = $this->super->report_out($data_where);
			$this->load->view('temp/showoff.php',$data);
		}
}