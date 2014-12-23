<?php 
class Db_model extends CI_Model{
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}	

	//homepage function
	function getcolumnnames($tablename){

		$this->load->database();		
		$database = $this->db->database;		
		$sql = "SELECT column_name FROM information_schema.columns WHERE table_name='".$tablename."' AND table_schema='".$database."'";
		$resultdata = $this->db->query($sql);
		$fieldArray = array();
		foreach ($resultdata->result() as $row) {
			$fieldArray[] = $row->column_name;			
		}		
		return $fieldArray;	
	}

	//bulk insert query function
	function insertbulkcsvdata($tablename,$data,$columnlist,$skip_element,$delimeter,$enclosed,$escape){

		$insertArray = array();
		foreach ($data as $data) {
		                $file_ext = $data['file_ext'];
		                $newname = $data['file_name']; 
		                $csvfile = base_url().'documents/'.$newname;		                	                		                
		                $row = 0;
						$count=0;
						$i=0;	
											
						if (($handle = fopen($csvfile, "r")) !== FALSE) {
														
						    while (($data = fgetcsv($handle, 1000, $delimeter)) !== FALSE) {
						        $num = count($data);
						        $columndata = explode(",", $columnlist);
						        
						        //if($count>$skip_element){  
						        	$keys = "";
						        	$values = "";						        	
						        	//create temporary array from codeignter.
						        	$temparray = array();
						        	for($i=0;$i<count($data);$i++){
										 
						        		$temparray[$columndata[$i]] = $data[$i];						        		
						        	}	
						        	array_push($insertArray,$temparray);
								$count++;
						    }
						    
						    fclose($handle);
							$this->db->insert_batch($tablename,$insertArray);
						    //die;
						    //print_r($insertArray); die;
						}
		        }
	}
	
}
?>