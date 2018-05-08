<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shared extends CI_Controller {
	public function search_hospital(){
		//echo $this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('hospitals');
		$this->db->like('district_name',$this->uri->segment(3));
		$res1 = $this->db->get();
		$data['hospitals'] = $res1->result();
		$this->load->view('share_folder/list.php',$data);
	}
}