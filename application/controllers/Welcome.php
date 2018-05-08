<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{	
		$data = array();
		$data['title'] = "CRM-Edge Point | Login";
		$this->load->view('temp/heading',$data);
		$this->load->view('login/login');
		//$this->load->view('temp/footer');
	}
	public function set(){
		$username_i = $this->input->post('username');
		$array_where = array(
			'username' => $this->input->post('username'), //$_POST['username']
			'password' => $this->input->post('password')
			);
		$this->db->select('*');
		$this->db->from('usertable');
		$this->db->where($array_where);
		$query = $this->db->get();
		$row = $query->row_array();
		if(isset($row)){
			$update_where = array(
					'username' => $username_i
				);
			$update_data = array(
					'status' => 1,
					'lastlogin' => null
				);
			$this->db->where($update_where);
			$this->db->update('usertable',$update_data);
			$password = $row['fullname'];
			$user_data['user_data'] = array(
					'role' => $row['role'],
					'fullname' => $row['fullname'],
					'username' => $row['username'],
					'agent_name' => $row['agent'],
					'islogedon' => TRUE
				);
			$this->session->set_userdata($user_data);
			if($this->session->user_data['role'] == 'Supervisor'){
				redirect(base_url('supervisor'));
			}else if($this->session->user_data['role'] == 'Agent'){
				redirect(base_url('Care/listc'));
			}else if($this->session->user_data['role'] == 'Technician'){
				redirect(base_url('technician'));
			}
		}else{
			$this->session->set_flashdata('error','Wrong username or password');
			redirect(base_url('welcome'));
		}
		
	}

	public function logout(){
		$update_where = array(
					'username' => $this->session->user_data['username']
				);
			$update_data = array(
					'status' => 0
				);
			$this->db->where($update_where);
			$this->db->update('usertable',$update_data);
		$this->session->unset_userdata('user_data');
		redirect(base_url('welcome'));
	}
}