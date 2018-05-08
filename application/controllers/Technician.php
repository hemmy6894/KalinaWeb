<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Technician extends CI_Controller {
	 public function __construct()
        {
                parent::__construct();
                $this->session_direct();
        }
		
	public function new_entry(){
		$this->load->model('Technician_model','tech');
		$data['new_data'] = $this->tech->select('new');
		$this->load->view('technician/dashboard',$data);
	}
	
	public function index(){
		$data['title'] = "CRM Edgepoint | Technician";
		$this->load->model('Technician_model','tech');
		$data['closed'] = $this->tech->select('closed');
		$data['progress'] = $this->tech->select('progress');
		$data['username'] = "Technician"; //$this->session->user_data['username'];
		$this->load->view('temp/heading',$data);
		$this->load->view('temp/navitech');
		$this->load->view('technician/techview');
		$this->load->view('temp/footer');
	}
	
	public function change_pass(){
		$old = $this->input->post('oldpass');
		$new = $this->input->post('newpass');
		$conf = $this->input->post('confirm');
		$username = $this->session->user_data['username'];
		
		$where_data = array(
			'username' => $username,
			'password' => $old
		);
		
		$update_data = array(
			'password' => $new
		);
		$update_where = array(
			'username' => $username
		);
		$this->db->select('*');
		$this->db->from('usertable');
		$this->db->where($where_data);
		$value = $this->db->get();
		if($value->num_rows() == 1){
			$this->db->where($update_where);
			$wr = $this->db->update('usertable',$update_data);
			if($wr){
				$this->session->set_flashdata('ok_password','password updated');
			}else{
				$this->session->set_flashdata('not_password','password failed to update');
			}
		}else{
			$this->session->set_flashdata('not_password','wrong password');
		}
		redirect(base_url('Technician'));
	}
	
	public function action(){
		if(($this->uri->segment(3) !== null) && ($this->uri->segment(4) !== null)){
			$state = $this->uri->segment(3);
			$user = $this->uri->segment(4);
			if($state == 'close' || $state == 'open' || $state == 'progress'){
				if($state == 'close'){
					$state = 'closed';
				}else if($state == 'open'){
					$state = 'new';
				}else if($state == 'progress'){
					$state = 'progress';
				}
				
				$update = array(
					'status' => $state
				);
				$updatew = array(
					'ticketId' => $user
				);
				
				$this->db->where($updatew);
				$this->db->update('queries',$update);
				
				$this->session->set_flashdata('tech_success','Success!!');
				redirect(base_url('Technician'));
			}else{
				$this->session->set_flashdata('tech_error','Sorry: Url not found');
				redirect(base_url('Technician'));
			}
		}
	}
	public function session_direct(){
		if(($this->session->user_data['islogedon'] == FALSE) || ($this->session->user_data['role'] != 'Technician')){
			$this->session->unset_userdata('user_data');
			$this->session->set_flashdata('error','You must login');
			redirect(base_url('welcome'));
		}
	}
}
?>