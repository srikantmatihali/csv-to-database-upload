<?php require_once 'includes/global.php';
$a = dbconnect();

$csvfile = ""; $csvfile_name = "";
$filter = "documents";
$uploaddir= $uploaddirectory."data/";

if($_POST){	
  if($_FILES['csvfile']){	
	//upload csv file and grab data from this.
	 if($_FILES['csvfile']['size']>0){ 
	 
		$filename1 = array($_FILES['csvfile']);		    
		$csvfile_name = upload_simple_files($filename1,$uploaddir,$filter);
				
		$csvfile = $uploaddir.$csvfile_name;
		$columnlist= escape_data($_POST['columnlist']);
		$tablename= escape_data($_POST['tablename']);
		$skip_element = escape_data($_POST['skip_element']);
		$delimeter = escape_data($_POST['delimiter']);
		$enclosure = escape_data($_POST['enclosed']);
		$escape = escape_data($_POST['escape']);		
			
		$row = 1;
		$count=0;
		$i=0;
		$inserttext = 'INSERT INTO '.$tablename;
		if (($handle = fopen($csvfile, "r")) !== FALSE) {
			//while (($data = fgetcsv($handle, 1000, $delimeter,$enclosure,$escape)) !== FALSE) { //escape character added in 5.30.
		    while (($data = fgetcsv($handle, 1000, $delimeter)) !== FALSE) {
		        $num = count($data);
		        $columndata = explode(",", $columnlist);
		        
		        if($count>$skip_element){        	
		        	
		        	$keys = "";
		        	$values = "";
		        	for($i=0;$i<count($data);$i++){
						  $columndata[$i]."==>".$data[$i];// echo "<br/>";		        	
			        	  $keys .= ",".$columndata[$i]."";
			        	  $values .= ",'".addslashes($data[$i])."'";
		        	}
		        	
		        	$keys = substr($keys, 1,strlen($keys));
		        	$values = substr($values, 1,strlen($values));
		        	
		        	$insertdata = $inserttext."(".$keys.")"."VALUES (".$values.");";        
			      	mysqli_query($a,$insertdata) or die("query failed ".mysqli_error()); //return mysql_insert_id();	//print_r($data); 			
					echo "<hr/>";
		        }
				$count++;
		    }
		    fclose($handle);
		} 
	  } else {echo "Please upload a file.";}
	}else {	echo "Please upload a file.";}
	//end of file upload check.
}// end of post
?>