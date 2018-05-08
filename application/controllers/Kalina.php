<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalina extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
        }
		
	//Home page
	public function index(){
		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');
	}
	
	//About US
	public function about(){
		$this->load->view('header');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	//Contact Page
	public function contact(){
		$this->load->view('header');
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	//Service page
	public function service(){
		$this->load->view('header');
		$this->load->view('service');
		$this->load->view('footer');
	}
	
	//Wait for payment confirmation before continue with this project A free right now give me the parts nife navyo broo!!
}