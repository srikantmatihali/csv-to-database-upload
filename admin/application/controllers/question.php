<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller{
	function __construct(){
		parent::__construct();		
	}

	public function index()
	{
	
		$this->questionupload();		
	}	
	public function questionupload(){

		$this->load->library('session');			
		$this->load->helper('common');
		$tablename = $this->config->item('tablename');
	 	$data['column_names'] = getcolumnnames($tablename);	 	
		$this->load->view('questionupload',$data);						
	}	
	
	function test(){
	echo "ssss";die;
	}

	//homepage function
	function uploadcsv(){
		
		$csvfile = ""; $csvfile_name = "";
		$filter = "documents";
		
		$config['upload_path'] = './documents/';
		$config['allowed_types'] = 'csv';
		$config['max_size']	= '3000';				
	
		$this->load->library('upload');
		$this->upload->initialize($config);
		$field_name = 'csvfile';
		if ( ! $this->upload->do_upload($field_name)){
			$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);					
			//add error page.
		}else{  

			$data = array('upload_data' => $this->upload->data());
			$this->load->helper('common');
			
			$tablename = $this->config->item('tablename');
			$skip_element = $this->input->post('skip_element');
			//echo  $delimeter = $this->input->post('delimeter'); 
			$delimeter = ',';
			$enclosed = $this->input->post('enclosed');
			$escape = $this->input->post('escape');
			$columnlist = $this->input->post('columnlist');	

		    $data['result'] = insertcsvdata($tablename,$data,$columnlist,$skip_element,$delimeter,$enclosed,$escape);
		}			
	}//end of function

	//savedata function
	function savequestion(){   
	}

	//set generation question module
	function setgeneration(){
        
	}

	//view questions
	function viewquestion(){

	}

	//edit single question
	function singlquestion($qid){

	}

	//delete single question
	function deletequestion($qid){

	}
}