<?php require_once 'includes/global.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSV IMPORT TOOL</title>
</head>
<body>

<?php 
if($_GET){	
	$tablename = escape_data($_GET['table']);
	$primaryid = escape_data($_GET['key']);	
 	$result = getcolumnnames($tablename);//getcolumnnames($tablename);
 	$column_names = join(",", $result);
 	
 //	print_r($result);?>
 	<div>
		<h1>IMPORT CSV DATA TO DATABASE.</h1>
		<form action="csv.php" method="post" enctype='multipart/form-data' >
		
			<p><label>Upload CSV file</label><br/><input type="file" name="csvfile" /></p>		
			<p><label>Table Name</label><br/><input type="text" name="tablename" value="<?php echo $tablename;?>" /></p>
			<p><label>Database Name</label><br/><input type="text" name="database" value="<?php echo $database;?>" /></p>
			
			<div style="border:1px solid black;padding:5px 5px 5px 5px;">
				<strong>Options</strong>
				<p><label>Number of records(queries) to skip from start</label><br/><input type="text" name="skip_element" /></p>	
				<p><label>Fields terminated by</label><br/><input type="text" name="delimiter" value="" /></p>
				<p ><label>Fields enclosed by</label><br/><input type="text" name="enclosed" value='"' /></p>
				<p ><label>Fields escaped by</label><br/><input type="text" name="escape" value="//" /></p>
				<p ><label>Column Names</label><br/><textarea cols="100" name="columnlist"><?php echo $column_names;?></textarea></p>
		    </div>
					
			<p><input type="submit" value="submit" /></p>
		</form>
 	</div>	
<?php 

}else{ ?>
	<form action="csv-table.php" method="get">
	<p><label>Table</label><br/><input type="text" name="table" /></p>
	<p><label>Primary Key</label><br/><input type="text" name="key" /></p>
	<p><input type="submit" value="submit" /></p>
	</form>
<?php 
	}
?>

<!--<textarea>-->
<!-- -end php code here -->
<!--</textarea>-->
</body>
</html>