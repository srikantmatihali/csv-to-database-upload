<?php date_default_timezone_set('Asia/Kolkata');

//initial parameters setup.
$username = 'root';
$password = '';
$host = 'localhost';
$database = 'p';

//ALL DB AND OTHER ACTIONS
/*

	SERVER database connection

	*/

	function dbconnect(){

		$connection = mysqli_connect($host,$username,$password);
		//$connection = mysqli_connect('localhost','skinnu','skinnr!23');

		if(!$connection){

		return false;

		}

		

		//if(!mysqli_select_db($connection_server,'groupbuy')){

		if(!mysqli_select_db($connection,$database)){

		return false;

		}

		return $connection;

	}

	

	/*

	Query Executor for display function and returns result in array

    $query - sql query [even multiple query works]

	*/

	function basic_display($query){

    	$a = dbconnect();		

		$result = mysqli_query($a,$query) or die("query failed ".mysqli_error());

		$result = db_results($result);

		return $result;	

	}	

	

	/*

	Basic Display

	$table - Table Name

	$Order - Order by which field

	$by - ASC or DESC0

	*/

	function display($table,$order,$by){

		

		$a = dbconnect();

		$query = "SELECT * FROM $table ORDER BY $table.$order $by";

		$result = mysqli_query($a,$query) or die("query failed ".mysqli_error());

		$result = db_results($result);

		return $result;

	}
	/*

	Display selected

	Need to upgrade this function with count

	$table - Table Name

	$where - Where Query

	*/

	

		function display_selected($table,$where){

		$a = dbconnect();

		$query = "SELECT * FROM $table $where";  

		$result = mysqli_query($a,$query)or die("query failed ".mysqli_error());

		$result = db_results_assoc($result);

		return $result;



	}

	

	/*

	Result pop

	Required for display function

	*/

	function db_results($result){

	

		$res_array = array();

		for($count=0;$row = mysqli_fetch_array($result);$count++)

			{

				$res_array[$count] = $row;

			}

		return $res_array;

	}

	

	/*

	Universal Insert System

	*/

	//include("settings.php");

	function insert($info, $table) {

		$a = dbconnect();

   		if (!is_array($info)) { die("insert failed, info must be an array"); }

      	$sql = "INSERT INTO ".$table." (";

      	for ($i=0; $i<count($info); $i++) {

     		$sql .= key($info);

     		if ($i < (count($info)-1)) {

        		$sql .= ", ";

     		} else $sql .= ") ";

        next($info);

     }

     reset($info);

     $sql .= "VALUES (";

     for ($j=0; $j<count($info); $j++) {

        $sql .= "'".current($info)."'";

        if ($j < (count($info)-1)) {

           $sql .= ", ";

        } else $sql .= ") ";

        next($info);

     }

         //execute the query

     mysqli_query($a,$sql) or die("query failed ".mysqli_error());

         return mysqli_insert_id();

      } 

	  

	  /*

	  Basic update Function

	  

	  */

	  	function update_simple($table,$data,$where) {

		 $a = dbconnect();

		 $query = "UPDATE $table SET $data $where";

		 $result = mysqli_query($a,$query)or die("query failed ".mysqli_error($a));

		//$result = db_results($result);

		return $result;

      } 

	  

	   /*

	  Basic delete Function

	  

	  */

	  

	  function delete_simple($table,$where) {

		 $a = dbconnect();

		 $query = "DELETE FROM $table $where";

		 $result = mysqli_query($a,$query)or die("query failed ".mysqli_error());

		//$result = db_results($result);

		return $result;

      } 
      
      /*

					ACTION: Upload Files

					$filename = Passess the FILE ARRAY

					$uploaddir = DIRECTORY to upload the file

					$filter = To filter file type images, documents, videos, all

					*/

					function upload_simple_files($filename,$uploaddir,$filter){

							//FILE TYPES FILTER

							$ftype1 = array("png","jpg","jpeg","gif","JPEG");

							$ftype2 = array("txt","doc","pdf","xml","xls","docx","csv");

							$ftype3 = array("mp4","avi","mp3","3gb","fla","swf","flv");

							$ftype4 = array("png","jpg","jpeg","gif","txt","doc","pdf","xml","xls","docx","mp4","avi","mp3","3gb","fla","swf");

							

							//UPLOAD DIRECTORY TO BE PASSED

							$filelocation = $uploaddir;				

							//print_r($filename[0]); die();

							

							//GRAB EXTENSION AND VALID THE FILTER MODE

						    $extension = findexts($filename[0]['name']);	
							$randomname = rand(0,99999999999999);							$newfilename = $randomname.".".$extension;
							//FILTER VALIDATION							
							if($filter == "images"){   
							//$f = in_array($extension,$ftype1); print_r($f); die();                   

								if(in_array($extension,$ftype1)){									

											 $flag = 1;  

		                                     

											}

											else

											{

											$flag = 0;	

											}

							}

							else

							if($filter == "documents"){

								if(in_array($extension,$ftype2)){

											$flag = 1;

											}

											else

											{

											$flag = 0;	

											}

							}

							else

							if($filter == "videos"){

								if(in_array($extension,$ftype3)){

											$flag = 1;

											}

											else

											{

											$flag = 0;	

											}

								

							}

							else

							if($filter == "all"){

								if(in_array($extension,$ftype4)){

											$flag = 1;

											}

											else

											{

											$flag = 0;	

											}

							}

							else

							{

							$message = "FILTER MODE NOT SELECTED";

							return $message;

							}

							//echo $newfilename;

							//die();

							

							$target_path = $filelocation.$newfilename;   

							if($flag==1){ 							//print_r($filename); echo $target_path;// die();

						    	if(move_uploaded_file($filename[0]['tmp_name'], $target_path)){ 

								 // echo "HERE";

								  //die();

								  //echo $target_path;

								  $message = $newfilename;

								   return $message;

							     }

							    else

							    {

									//echo $filename;

									//die();

									$error = "No File Selected";

									return $error; 	

								}

							}

							else

							{

								$message = "Invalid File type. Please upload supported file types";

								return $message;

							}

						

					}

					

					//TO FIND FILE EXTENSION

					function findexts ($filename) { 

					$filename = strtolower($filename) ;

					$exts = @split("[/\\.]", $filename) ; 

					$n = count($exts)-1; 

					$exts = $exts[$n]; 

					return $exts;

					}
					
function display_selected_assoc($table,$fields,$where){

		$a = dbconnect();



		$query = "SELECT $fields FROM $table $where"; 
//echo $query;


		$result = mysqli_query($a,$query)or die("query failed ".mysqli_error());

		

		//$result = mysqli_fetch_array($result);

		$result = db_results_assoc($result);

		return $result;

 	}

 	

 	//result by using assoc

 	function db_results_assoc($result){



	



		$res_array = array();



		for($count=0;$row = mysqli_fetch_assoc($result);$count++)



			{



				$res_array[$count] = $row;



			}



		return $res_array;



	}

	

	//PROTECT FROM SQL ATTACK

	function escape_data($data) { 

	$a = dbconnect();

	//global $dbc; // Database connection.	

	// Strip the slashes if Magic Quotes is on:

	//if (get_magic_quotes_gpc()) 

	$data = stripslashes($data);	

	// Apply trim() and mysqlii_real_escape_string():

	return mysqli_real_escape_string($a,trim($data));

	

} // End of the escape_data() function.


function db_display_selected($table,$fields,$where){
		$a = dbconnect();

		$query = "SELECT $fields FROM $table $where"; 
//echo $query;
		$result = mysqli_query($a,$query)or die("query failed ".mysqli_error());

		$result = mysqli_fetch_array($result);
		//print_r($result);
		//$result = db_results_assoc($result);
		return $result;
}

function getcolumnnames($tablename){
	$a = dbconnect();
	$connection = dbconnect();
	$query = "SELECT column_name FROM information_schema.columns WHERE table_name='".$tablename."' AND table_schema='".$database."'";
	
	$result = mysqli_query($connection,$query) or die("query failed ".mysqli_error());
	$fieldArray = array();
	while($row = mysqli_fetch_assoc($result)){
			$fieldArray[] = $row['column_name'];
	}
	return $fieldArray;	
}


//gets time from milliseconds
function formatMilliseconds($milliseconds) {
    $seconds = floor($milliseconds / 1000);
    $minutes = floor($seconds / 60);
    $hours = floor($minutes / 60);
    //$milliseconds = $milliseconds % 1000;
    $seconds = $seconds % 60;
    $minutes = $minutes % 60;

    //$format = '%u:%02u:%02u.%03u';
    $format = '%u:%02u:%02u';
    $time = sprintf($format, $hours, $minutes, $seconds);
    return rtrim($time, '0');
}

//gets milliseconds from time.
function getMilliSeconds($time){
	list($hours,$mins,$secs) = explode(':',$time);
	$seconds = mktime($hours,$mins,$secs) - mktime(0,0,0);
	return $seconds;
}	

//get ipaddress
function getIpAddress(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    	$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
    	$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}				

