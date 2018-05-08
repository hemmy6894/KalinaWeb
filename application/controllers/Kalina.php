<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalina extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
        }
		
	public function index(){
		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');
	}
	
	public function about(){
		$this->load->view('header');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function contact(){
		$this->load->view('header');
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	public function service(){
		$this->load->view('header');
		$this->load->view('service');
		$this->load->view('footer');
	}
}