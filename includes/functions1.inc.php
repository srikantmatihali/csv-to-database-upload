<?php
/*	SERVER database connection

	*/

function db_connect(){	

$connection_server=mysql_connect('localhost','root','');

if(!$connection_server){

   return false;	}

$connection_db=mysql_select_db('p');

if(!$connection_db){

	return false;

}	return $connection_server;

}	

	/* To protect from SQL injection */

	

	function escape_data($data) { 

	db_connect();

	//global $dbc; // Database connection.	

	// Strip the slashes if Magic Quotes is on:

	//if (get_magic_quotes_gpc()) 

	$data = stripslashes($data);	

	// Apply trim() and mysqli_real_escape_string():

	return mysql_real_escape_string(trim($data));

	

} // End of the escape_data() function.

	/*

	Query Executor for display function and returns result in array

    $query - sql query [even multiple query works]

	*/

	function basic_display($query){

    	db_connect();
    			

		$result = mysql_query($query) or die("query failed ".mysql_error());

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

		db_connect();

		$query = "SELECT * FROM $table ORDER BY $table.$order $by";

		$result = mysql_query($query) or die("query failed ".mysql_error());

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



		db_connect();



		echo $query = "SELECT * FROM $table $where";  

     

		$result = mysql_query($query)or die("query failed ".mysql_error());



		$result = mysql_fetch_array($result);

		//$result = db_results($result);



		return $result;







	}



	



	/*



	Result pop



	Required for display function



	*/



	function db_results($result){



	



		$res_array = array();



		for($count=0;$row = mysql_fetch_array($result);$count++)



			{



				$res_array[$count] = $row;



			}



		return $res_array;



	}



	



	/*



	Universal Insert System



	*/



	function insert($info, $table) {



		db_connect();



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

     mysql_query($sql) or die("query failed ".mysql_error());



         return mysql_insert_id();



      } 



	  



	  /*



	  Basic update Function



	  



	  */



	  	function update_simple($table,$data,$where) {

		 db_connect();

		 $query = "UPDATE $table SET $data $where"; 

		 $result = mysql_query($query)or die("query failed ".mysql_error());

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

	   /*



	  Basic delete Function



	  



	  */



	  



	  function delete_simple($table,$where) {



		 db_connect();



		 $query = "DELETE FROM $table $where";



		 $result = mysql_query($query)or die("query failed ".mysql_error());



		//$result = db_results($result);



		return $result;



      } 

	  

	  

	   function randomcode($length)

{

$random= "";

srand((double)microtime()*1000000);



$data = "AbcDE123IJKLMN67QRSTUVWXYZ";

$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";

$data .= "0FGH45OP89";



for($i = 0; $i < $length; $i++)

{

$random .= substr($data, (rand()%(strlen($data))), 1);

}



return $random;

}


//function to return fieldnames used in database

function select_field($table){

		db_connect();

		$query = "SELECT * FROM $table";

		$result = mysql_query($query) or die("query failed ".mysql_error()) ;

		$count = mysql_num_rows($result);

		$row = mysql_fetch_row($result); 

		$columncount = count($row);

		$i=0;

		$result_array= array();

		while($i<$columncount){

		 $result_array[$i]= mysql_field_name($result,$i);

		 $i++;

		}

		return $result_array;

  }

  

  function custom_pagination($tbl_name,$where,$limit,$path,$style){

		$query = "SELECT COUNT(*) as num FROM $tbl_name $where"; 

		$total_pages = mysql_fetch_array(mysql_query($query));

		$total_pages = $total_pages['num'];

		$adjacents = "2";

		$page = @$_GET['page'];

		if($page)

		  $start = ($page - 1) * $limit;

		else

		  $start = 0;

		$sql = "SELECT id FROM $tbl_name $where LIMIT $start, $limit"; 

		$result = mysql_query($sql);

		

		if ($page == 0) $page = 1;

		 $prev = $page - 1;

		 $next = $page + 1;

		 $lastpage = ceil($total_pages/$limit);

		 $lpm1 = $lastpage - 1;							

		 $pagination = "";

		 if($lastpage > 1){   

			$pagination .= "<div class='".$style."'>";

		    if ($page > 1)

				 $pagination.= "<a href='".$path."page=$prev' class='buttonPrev'>Prev Page</a>";

			else

				 $pagination.= "<span  class='buttonPrev'>Prev Page</span>";	

				 

          //dropdown with page numbers.

		  $pagination .= " <select name='pageno1' id='pageno1' onchange=\"javascript:var x= '".$path."page='+document.getElementById('pageno1').value;window.location= x;\" >";				 

		  for ($counter = 1; $counter <= $lastpage; $counter++){

				$pagination .= "<option";

			     if($page==$counter){

			       $pagination .= " selected='selected' ";	

			     }

				$pagination .=">";

				$pagination .= $counter."</option>";								                  

		  }		

		  $pagination = $pagination."</select> ";

		  //end of pagenumber				

		if ($page < $lastpage)

					$pagination .= "<a href='".$path."page=$next' class='buttonNext'>Next Page</a>";

		else

				$pagination.= "<span  class='buttonNext'>Next Page</span>";

				$pagination.= "</div>\n";       

		}

		 return $pagination;

	}

  

  					

						/*

						PAGINATION SYSTEM (SIMPLE PAGINATION)

						$table = $table name

						$limit = how many rows to show

						$pagepath = the link for navigation

						$style = style code for pagination. Only master style code needs to be changed

						*/

						

						function pagination($tbl_name,$limit,$path,$style)

						{

							 $query = "SELECT COUNT(*) as num FROM $tbl_name";

							$total_pages = mysql_fetch_array(mysql_query($query));

							$total_pages = $total_pages['num'];

							$adjacents = "2";

							$page = @$_GET['page'];

							if($page)

							$start = ($page - 1) * $limit;

							else

							$start = 0;

						

							 $sql = "SELECT id FROM $tbl_name LIMIT $start, $limit";

							$result = mysql_query($sql);

							

								if ($page == 0) $page = 1;

								$prev = $page - 1;

								$next = $page + 1;

								$lastpage = ceil($total_pages/$limit);

								$lpm1 = $lastpage - 1;

							

								$pagination = "";

							if($lastpage > 1){   

								$pagination .= "<div class='".$style."'>";

							if ($page > 1)

								$pagination.= "<a href='".$path."page=$prev'>previous</a>";

							else

								$pagination.= "<span class='disabled'>previous</span>";   

							

							if ($lastpage < 7 + ($adjacents * 2)){   

								for ($counter = 1; $counter <= $lastpage; $counter++){

									if ($counter == $page)

										$pagination.= "<span class='current'>$counter</span>";

									else

										$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

								}

							}

							elseif($lastpage > 5 + ($adjacents * 2))

							{

								if($page < 1 + ($adjacents * 2)){

									for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){

										if ($counter == $page)

											$pagination.= "<span class='current'>$counter</span>";

										else

											$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

									}

									$pagination.= "...";

									$pagination.= "<a href='".$path."page=$lpm1'>$lpm1</a>";

									$pagination.= "<a href='".$path."page=$lastpage'>$lastpage</a>";       

								}

								elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){

									$pagination.= "<a href='".$path."page=1'>1</a>";

									$pagination.= "<a href='".$path."page=2'>2</a>";

									$pagination.= "...";

									for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){

											if ($counter == $page)

												$pagination.= "<span class='current'>$counter</span>";

											else

												$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

									}

									$pagination.= "..";

									$pagination.= "<a href='".$path."page=$lpm1'>$lpm1</a>";

									$pagination.= "<a href='".$path."page=$lastpage'>$lastpage</a>";       

								}

								else{

									$pagination.= "<a href='".$path."page=1'>1</a>";

									$pagination.= "<a href='".$path."page=2'>2</a>";

									$pagination.= "..";

									for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){

										if ($counter == $page)

											$pagination.= "<span class='current'>$counter</span>";

										else

											$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

									}

								}

							}

							

							if ($page < $counter - 1)

								$pagination.= "<a href='".$path."page=$next'>next</a>";

							else

								$pagination.= "<span class='disabled'>next</span>";

								$pagination.= "</div>\n";       

							}



							

							return $pagination;

						}  



                   //TO FIND FILE EXTENSION

					function findexts ($filename) { 

					$filename = strtolower($filename) ;

					$exts = @split("[/\\.]", $filename) ; 

					$n = count($exts)-1; 

					$exts = $exts[$n]; 

					return $exts;

					}

                 //functions for getting current url

                

					function curPageURL() {

					 $pageURL = 'http://';

					 if(isset($_SERVER["HTTPS"]) == "on") {$pageURL .= "s";}



					 if (@$_SERVER["SERVER_PORT"] != "80") {

					  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

					 } else {

					  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

					 }

					 return $pageURL;

					}

					//Function to display with array assoc

 	function display_selected_assoc($table,$fields,$where){

		db_connect();



		 $query = "SELECT $fields FROM $table $where"; 



		$result = mysql_query($query)or die("query failed ".mysql_error());



		//$result = mysql_fetch_array($result);

		$result = db_results_assoc($result);

		return $result;

 	}

 	

 	//result by using assoc

 	function db_results_assoc($result){



	



		$res_array = array();



		for($count=0;$row = mysql_fetch_assoc($result);$count++)



			{



				$res_array[$count] = $row;



			}



		return $res_array;



	}

	

	function db_display_selected($table,$fields,$where){

		db_connect();



		$query = "SELECT $fields FROM $table $where"; 



		$result = mysql_query($query)or die("query failed ".mysql_error());



		$result = mysql_fetch_array($result);

		//$result = db_results_assoc($result);

		return $result;

	}

	

	function user_name($email)

	{

		$i=0;

		while($email[$i]!='@')

		{

			$i++;

		}

		$uname=substr($email,0,$i);

		return $uname;

		

	}

//function to return column names
function getcolumninfo($table){
db_connect();
$returnresult = '';
$query = 'select * from '.$table;
$result = mysql_query($query)or die("query failed ".mysql_error());
if (!$result) {
    die('Query failed: ' . mysql_error());
}
/* get column metadata */
$i = 0;
while ($i < mysql_num_fields($result)) {
    $returnresult.="Information for column $i:<br />\n";
    $meta = mysql_fetch_field($result, $i);
    if (!$meta) {
        echo "No information available<br />\n";
    }
		$returnresult.="<pre>
	blob:         $meta->blob
	max_length:   $meta->max_length
	multiple_key: $meta->multiple_key
	name:         $meta->name
	not_null:     $meta->not_null
	numeric:      $meta->numeric
	primary_key:  $meta->primary_key
	table:        $meta->table
	type:         $meta->type
	unique_key:   $meta->unique_key
	unsigned:     $meta->unsigned
	zerofill:     $meta->zerofill
	</pre>";
    $i++;
}
	return $returnresult;
}

function getcolumnnames($table){
db_connect();
$returnresult = array();
$query = 'select * from '.$table;
$result = mysql_query($query)or die("query failed ".mysql_error());
if (!$result) {
    die('Query failed: ' . mysql_error());
}
/* get column metadata */
$i = 0;
while ($i < mysql_num_fields($result)) {
	$returnresult[$i]= mysql_field_name($result, $i);    
    $i++;
}	return $returnresult;
}



 //function to send email.
 function mailsend($to,$subject,$message,$frommail){
 	$flag= false;
	$headers = "From:  $frommail \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = '<html><body>'.$message.'</body></html>';
	$sendmail = mail($to,$subject,$message,$headers);
	if($sendmail){
		$flag= true;	
	}
	return $flag;
 }

 
 //function for selecting bocked id addresses 
 
  function block_ip_list()
  {
  	db_connect();
  	
  	$sql="select ipaddress from blockip where status = 1";
  	$res=mysql_query($sql) or die (mysql_error());
  	$block_ips=array();
  	while($data=mysql_fetch_array($res))
  	{
  		$block_ips[$i]=$data['ipaddress'];
  		$i++;
  	}
  	
  	return $block_ips;
  }
  
  //function for get visitor ip address	
	function getip()
 {

	  if (getenv(HTTP_X_FORWARDED_FOR)) {
	        $ip_address = getenv(HTTP_X_FORWARDED_FOR);
	    } else {
	        $ip_address = getenv(REMOTE_ADDR);
	    }
	return $ip_address;
 } 
  
  
  
  //new functions written for titan project
  //gets ip and finds   
  //Get locations data.
 function locationdata($ipaddress){ 	
 	include('includes/ip2locationlite.class.php');
 	//Load the class
	$ipLite = new ip2location_lite;
	$ipLite->setKey('f79ddd317a4ccefd5b71dba4ce900d91b7c3177186475dfa09c87ba9805beea6'); 	 
 	$locations = $ipLite->getCity($ipaddress);	
 	return $locations; 	
 	
 	/*//Getting the result
	echo "<p>\n";
	echo "<strong>First result</strong><br />\n";
	if (!empty($locations) && is_array($locations)) {
	  foreach ($locations as $field => $val) {
	    echo $field . ' : ' . $val . "<br />\n";
	  }
	}
	echo "</p>\n";*/ 	
 }
 
 
  
  
?>