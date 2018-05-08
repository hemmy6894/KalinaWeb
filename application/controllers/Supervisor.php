<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor extends CI_Controller {
	
	   public function __construct()
        {
                parent::__construct();
                $this->session_direct();
        }
		
	public function index(){
		$data = array();
		$data['title'] = "CRM-Edge Point | Supervisor ";
		$this->load->model('Super_model','today');
		
		$data['today_agents'] = $this->today->selection_day();
		$data['today_number'] = $this->today->number();
		
		//$data['calling_time'] = $this->today->calculate_time('j');
		///Annual
		$data['annual_agents'] = $this->today->selection_day();
		$data['annual_agents_m'] = $this->today->selection_month();
		$data['annual_agents_y'] = $this->today->selection_year();
		$data['annual_number'] = $this->today->number();
		$data['annual_number_m'] = $this->today->number_month();
		$data['annual_number_y'] = $this->today->number_year();
		//End
		//select tag
		$data['view_tagging'] = $this->today->select_tag();
		$data['view_region'] = $this->today->select_region();
		//end
		$myage = $data['view_agents'] = $this->today->select_agent();
		$data['view_selected_agent'] = "no agents";
		if($myage)
		$data['view_selected_agent'] = $myage[0]->username;
		$data['view_selected_time'] = date('Y-m-d');
		if(!empty(urldecode($this->uri->segment(3)))){
			$agent = urldecode($this->uri->segment(3));
			$date = urldecode($this->uri->segment(4));
			$data['view_selected_agent'] = $agent;
			$data['view_selected_time'] = $date;
			$data['view_report'] = $this->today->select_by_date($agent,$date);
		}else{
			$agent = $data['view_selected_agent'];
			$date = $data['view_selected_time'];
			$data['view_report'] = $this->today->select_by_date($agent,$date);
		}

		$data['username'] = $this->session->user_data['username'];
		$data['active'] = array('','active','','','');
		$this->load->view('temp/heading',$data);
		$this->load->view('temp/navinew');
		$this->load->view('supervisor/superview');
		$this->load->view('temp/footer');
	}
	
	///region treee delete and add
	function add_region(){
		$region = $this->input->post('tagshow'); //$_POST['tagshow']; //
		$data_ins = array(
			'region_name' => $region
		);
		
		$this->db->insert('region',$data_ins);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('upload_success','added success');
			redirect(base_url('supervisor'));
		}else{
			$this->session->set_flashdata('upload_error','App Error');
			redirect(base_url('supervisor'));
		}
	}
	function delete_region(){
		$region = $this->uri->segment(3);
		$data_ins = array(
			'id' => $region
		);
		$this->db->where($data_ins);
		$this->db->delete('region');
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('upload_success','deleted success');
			redirect(base_url('supervisor'));
		}else{
			$this->session->set_flashdata('upload_error','App Error');
			redirect(base_url('supervisor'));
		}
	}
	
	///End delete and adding tagging treee
	
///Tagging treee delete and add
	function add_tag(){
		$tag = $this->input->post('tagshow'); //$_POST['tagshow']; //
		$data_ins = array(
			'tagname' => $tag
		);
		
		$this->db->insert('taggingtree',$data_ins);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('upload_success','added success');
			redirect(base_url('supervisor'));
		}else{
			$this->session->set_flashdata('upload_error','App Error');
			redirect(base_url('supervisor'));
		}
	}
	function delete_tag(){
		$tag = $this->uri->segment(3);
		$data_ins = array(
			'id' => $tag
		);
		$this->db->where($data_ins);
		$this->db->delete('taggingtree');
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('upload_success','deleted success');
			redirect(base_url('supervisor'));
		}else{
			$this->session->set_flashdata('upload_error','App Error');
			redirect(base_url('supervisor'));
		}
	}
	
	///End delete and adding tagging treee

	///Real time dahboard View
	function dashboard(){
		//Dashboard count data
		$this->load->model('Dashboard_model','admin');

		$data['dashboard_agent'] = $this->admin->view_agent();

		$data['dashboard_today_inc'] = $this->admin->today_incoming()[0]->total;
		$data['dashboard_today_out'] = $this->admin->today_outgoing()[0]->total;

		$data['dashboard_month_inc'] = $this->admin->month_incoming()[0]->total;
		$data['dashboard_month_out'] = $this->admin->month_outgoing()[0]->total;

		$data['dashboard_year_inc'] = $this->admin->year_incoming()[0]->total;
		$data['dashboard_year_out'] = $this->admin->year_outgoing()[0]->total;
		
		$data['dashboard_new'] = $this->admin->problem('new')[0]->total;
		$data['dashboard_closed'] = $this->admin->problem('closed')[0]->total;
		$data['dashboard_progress'] = $this->admin->problem('progress')[0]->total;
		//Dashboard count end
		$this->load->view('supervisor/dashboard',$data);
	}
	
	function real_annual(){
		///Annual
		$data['annual_agents'] = $this->today->selection_day();
		$data['annual_agents_m'] = $this->today->selection_month();
		$data['annual_agents_y'] = $this->today->selection_year();
		$data['annual_number'] = $this->today->number();
		$data['annual_number_m'] = $this->today->number_month();
		$data['annual_number_y'] = $this->today->number_year();
		
		$this->load->view('supervisor/overallreport',$data);
	}
	
	
	////End Real time dashboard
	public function today(){
		$data = array();
		$data['title'] = "CRM-Edge Point | Today report ";
		$this->load->model('Super_model','today');
		
		$data['agents'] = $this->today->selection_day();
		$data['number'] = $this->today->number();
		
		$data['username'] = $this->session->user_data['username'];
		$data['active'] = array('','active','','','');
		$this->load->view('temp/heading',$data);
		$this->load->view('temp/navigation_supper');
		$this->load->view('supervisor/todayreport');
		$this->load->view('temp/footer');
	}
	public function annual(){
		$data = array();
		$data['title'] = "CRM-Edge Point | Yearly ";
		$this->load->model('Super_model','today');
		
		$data['annual_agents'] = $this->today->selection_day();
		$data['annual_agents_m'] = $this->today->selection_month();
		$data['annual_agents_y'] = $this->today->selection_year();
		$data['annual_number'] = $this->today->number();
		$data['annual_number_m'] = $this->today->number_month();
		$data['annual_number_y'] = $this->today->number_year();
		
		$data['username'] = $this->session->user_data['username'];
		$data['active'] = array('','','','active','');
		$this->load->view('temp/heading',$data);
		$this->load->view('temp/navinew');
		$this->load->view('supervisor/overallreport');
		$this->load->view('temp/footer');
	}
	public function view_report(){
		$data = array();
		$data['title'] = "CRM-Edge Point | Yearly ";
		$this->load->model('Super_model','today');
		$myage = $data['view_agents'] = $this->today->select_agent();
		$data['view_selected_agent'] = "no agents";
		if($myage)
		$data['view_selected_agent'] = $myage[0]->username;
		$data['view_selected_time'] = date('Y-m-d');
		if(!empty(urldecode($this->uri->segment(3)))){
			$agent = urldecode($this->uri->segment(3));
			$date = urldecode($this->uri->segment(4));
			$data['view_selected_agent'] = $agent;
			$data['view_selected_time'] = $date;
			$data['view_report'] = $this->today->select_by_date($agent,$date);
		}else{
			$agent = $data['view_selected_agent'];
			$date = $data['view_selected_time'];
			$data['view_report'] = $this->today->select_by_date($agent,$date);
		}
		$data['username'] = $this->session->user_data['username'];
		$data['active'] = array('','','','','active');
		$this->load->view('temp/heading',$data);
		$this->load->view('temp/navinew');
		$this->load->view('supervisor/view_report');
		$this->load->view('temp/footer');
	}
	
	public function view_report_of(){
		$data = array();
		$data['title'] = "CRM-Edge Point | Yearly ";
		$this->load->model('Super_model','today');
		if(!empty(urldecode($this->uri->segment(4))) && !empty(urldecode($this->uri->segment(5)))){
			$type = urldecode($this->uri->segment(3));
			$agent = urldecode($this->uri->segment(4));
			$date = urldecode($this->uri->segment(5));
			$data['selected_agent'] = $agent;
			$data['selected_time'] = $date;
			if(!empty(urldecode($this->uri->segment(3)))){
				$data['agent_data'] = $this->today->select_agent_by($agent);
				$come = urldecode($this->uri->segment(3));
				$data['title'] = "CRM-EdgePoint | Report";
				if($come == 'd'){
					$data['report'] = $this->today->select_by_datey($agent,$date);
					$data['download_link'] = base_url('supervisor/download_excel/4/'.$agent.'/'.$date);
				}else if($come == 'm'){
					$month = $date;
					$year = urldecode($this->uri->segment(6));
					$data['report'] = $this->today->select_by_datem($agent,$month,$year);
					$data['download_link'] = base_url('supervisor/download_excel/6/'.$agent.'/'.$month.'/'.$year);
				}else if($come == 'y'){
					$data['report'] = $this->today->select_by_dateya($agent,$date);
					$data['download_link'] = base_url('supervisor/download_excel/7/'.$agent.'/'.$date);
				}else{
					redirect(base_url('supervisor'));
				}
			}
		}else{
			$data['report'] = false;
		}
		$data['username'] = $this->session->user_data['username'];
		$data['active'] = array('','','','','active');
		$this->load->view('temp/heading',$data);
		$this->load->view('temp/navinew');
		$this->load->view('supervisor/view_report_of');
		$this->load->view('temp/footer');
	}
	
	function test(){
		$data['title'] = "CRM-Edge Point | Yearly ";
		$data['active'] = array('','','','','active');
		$data['username'] = "Hemedi Mshamu";
		$this->load->view('temp/heading',$data);
		$this->load->view('supervisor/new_superview');
	}
	
	public function download_report(){
		if(!empty(urldecode($this->uri->segment(3))) && !empty(urldecode($this->uri->segment(4)))){		
			$agent = urldecode($this->uri->segment(3));
			$date = urldecode($this->uri->segment(4));
			$data['selected_agent'] = $agent;
			$data['selected_time'] = $date;
			$this->load->model('Super_model','today');
			$this->load->view('supervisor/download_excel');
		}else{
			redirect(base_url('supervisor/view_report'));
		}
	}
	
	public function download_excel(){
			$this->load->library('new_excel');
			$this->load->model('Super_model','today');
		if(!empty(urldecode($this->uri->segment(4))) && !empty(urldecode($this->uri->segment(5)))){
			$type = urldecode($this->uri->segment(3));
			$agent = urldecode($this->uri->segment(4));
			$date = urldecode($this->uri->segment(5));
			$data['selected_agent'] = $agent;
			$data['selected_time'] = $date;
			if(!empty(urldecode($this->uri->segment(3)))){
				$data['agent_data'] = $this->today->select_agent_by($agent);
				$what = urldecode($this->uri->segment(3));
				$data['title'] = "CRM-EdgePoint | Report";
				$d1 = urldecode($this->uri->segment(4));
				$d2 = urldecode($this->uri->segment(5));
				$d3 = urldecode($this->uri->segment(6));
				if($what == 1){
					$data_where = array(
						'DATE(date)' => $d1
					);
				}else if($what == 2){
					$data_where = array(
						'agent' => $d1
					);
				}else if($what == 3){
					$data_where = array(
						'DATE(date) >=' => $d1,
						'DATE(date) <=' => $d2
					);
				}else if($what == 4){
					$data_where = array(
						'agent' => $d1,
						'DATE(date)' => $d2
					);
				}else if($what == 5){
					$data_where = array(
						'agent' => $d1,
						'DATE(date) >=' => $d2,
						'DATE(date) <=' => $d3
					);
				}else if($what == 6){
					$data_where = array(
						'agent' => $d1,
						'MONTH(date)' => $d2,
						'YEAR(date)' => $d3
					);
				}else if($what == 7){
					$data_where = array(
						'agent' => $d1,
						'YEAR(date)' => $d2
					);
				}else{
					redirect(base_url('supervisor'));
				}
				$data['report'] = $this->today->report_out($data_where);	
			}
		}else{
			$data['report'] = false;
		}
		$datav = $data['report'];
		//print_r($datav);
		$filename = "report.xlsx";
		if($datav){
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Register Date');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Customer Name');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Phone Number');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Region');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Resolution');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Comment');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Agent');
			$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => '00a0FF')
					)
				)
			);
			$row = 2;
			foreach($datav as $d){
				$regdate = $d->regdate;
				$customer_name = $d->customer_name;
				$phone_number = $d->phone_number;
				$region = $d->region;
				$resolution = $d->resolution;
				$comment = $d->comment;
				$agent = $d->agent;
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $regdate);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $customer_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $phone_number);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $region);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $resolution);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $comment);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $agent);
				$row++;
			}
			foreach(range('A','F') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->setTitle('Report');
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename='.$filename);
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		}	
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
		redirect(base_url('supervisor'));
	}
	
	public function register_partner(){
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		
		$insert = array(
			'fullname' => $fullname,
			'username' => $username,
			'password' => $username,
			'role' => 'Agent',
			'status' => 1
		);
		
		$yes = $this->db->insert('usertable',$insert);
		if($yes){
			$this->session->set_flashdata('add_success','Successful Added');
		}else{
			$this->session->set_flashdata('add_error','Error in application');
		}
		redirect(base_url('supervisor'));
	}

	public function submit_hospital(){
		$hospitalname = $this->input->post('hospital');
		$regionname = $this->input->post('region');
		$districtname = $this->input->post('district');
		$phonenumber = $this->input->post('phone_number');
		$arename = $this->input->post('area');
		
		$insert = array(
			'hospita_name' => $hospitalname,
			'region_name' => $regionname,
			'district_name' => $districtname,
			'phone_number' => $phonenumber,
			'area' => $arename
		);
		
		$yes = $this->db->insert('hospitals',$insert);
		if($yes){
			$this->session->set_flashdata('add_success','Successful Added');
		}else{
			$this->session->set_flashdata('add_error','Error in application');
		}
		redirect(base_url('supervisor'));
	} 
	
	public function show_data(){
		//$select = array(
			//'date' => $this->input->post('date'),
			//'agent' => $this->input->post('agent')
		//);
		//$this->db->select($select);
		//$this->db->from('outgoing');
		//$r = $this->db->get();
		//print_r($r->result());
		
		echo "Hemedi";
	}
	
	public function readexcel($filename){
			$this->load->library('new_excel');
			$excelReader = PHPExcel_IOFactory::createReaderForFile($filename);
			$excelObj = $excelReader->load($filename);
			$worksheet = $excelObj->getActiveSheet();
			$lastLow = $worksheet->getHighestRow();
			echo  $lastLow;
			$myarray = array();
			
			for($row = 2; $row <= $lastLow; $row++){
				$myarray[$row]['regdate'] = $worksheet->getCell('E'.$row)->getValue();
				$myarray[$row]['customer'] = $worksheet->getCell('B'.$row)->getValue();
				$myarray[$row]['phone'] = $worksheet->getCell('C'.$row)->getValue();
				$myarray[$row]['region'] = $worksheet->getCell('D'.$row)->getValue();
				$myarray[$row]['agent'] = $worksheet->getCell('F'.$row)->getValue();
			}
			//echo "<br>array " . count($myarray);
			//print_r($myarray);
			//echo "<br>";
			/*echo $myarray[2]['regdate'];*/
			for($i = 2; $i <= (count($myarray)+1); $i++){ 
				$regdate = $myarray[$i]['regdate'];
				//echo "<br>";
				$customer = $myarray[$i]['customer'];
				$phone = $myarray[$i]['phone'];
				$region = $myarray[$i]['region'];
				$agent = $myarray[$i]['agent'];
				
				if($regdate != null){
					$insertdata = array(
							'regdate'  => $regdate,
							'customer_name'  => $customer,
							'phone_number'  => $phone,
							'region'  => $region,
							'region'  => $region
					);
					//print_r($insertdata);
					$this->db->insert('row_data',$insertdata);
					//echo "<br> Error " . $this->db->error()['message'] . "<br>";
				}
			}
		$this->session->set_flashdata('upload_success','Successful uploaded');
		redirect('supervisor');
	}
	
	public function do_upload()
        {
                $config['upload_path']          = 'upload/';
                $config['allowed_types']        = 'xls|xlsx';
                $filename = $config['file_name']       		= date('YmdHis');
		
				
                $this->upload->initialize($config);
				//$this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('upload_error','Error in Application');
                        redirect('supervisor');
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$filename = 'upload/'.$data['upload_data']['file_name'];
						$this->readexcel($filename);
                }
        }
		
	
	
	public function session_direct(){
		if(($this->session->user_data['islogedon'] == FALSE) || ($this->session->user_data['role'] != 'Supervisor')){
			$this->session->unset_userdata('user_data');
			$this->session->set_flashdata('error','You must login');
			redirect(base_url('welcome'));
		}
	}
}
