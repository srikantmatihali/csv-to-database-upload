<?php 
class Question extends CI_Model{
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}	

	//homepage function
	function home(){
		$this->load->view('questionupload');	
	}
}
?>