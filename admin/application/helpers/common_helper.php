<?php 
if (!function_exists('getcolumnnames')) {
	function getcolumnnames($tablename){
		$CI = & get_instance();		
		$CI->load->model('db_model');
		$result = $CI->db_model->getcolumnnames($tablename); 
		return $result;
	}
}

if (!function_exists('insertcsvdata')) {
	function insertcsvdata($tablename,$data,$columnlist,$skip_element,$delimeter,$enclosed,$escape){
		$CI = & get_instance();		
		$CI->load->model('db_model');
		$result = $CI->db_model->getcolumnnames($tablename); 
		$result = $CI->db_model->insertbulkcsvdata($tablename,$data,$columnlist,$skip_element,$delimeter,$enclosed,$escape); 		
		return $result;
	}
}

?>