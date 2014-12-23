<?php $columns = join(",", $column_names);?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Infosys | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
<?php include 'header.php';?>
        <div class="wrapper row-offcanvas row-offcanvas-left">

		<?php include 'leftsidebar.php';?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Blank page
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Maps</li>
                    </ol>
                </section>
                            

                <!-- Main content -->
                <section class="content">
				 	<div>
						<h1>IMPORT CSV DATA TO DATABASE.</h1>
						<form action="<?php echo base_url();?>question/uploadcsv/" method="post" enctype='multipart/form-data' >
							<p><label style="font-weight:bold;">Note:</label>  Please have below columns in csv file<br/><?php echo $columns;?>
							<input type="hidden" id="columnlist" name="columnlist" value="<?php echo $columns;?>" />	
							</p>
							<p><label>Upload CSV file</label><br/>
							<input type="file" name="csvfile" id="csvfile" /></p>
							<p><label>Number of records(queries) to skip from start</label><br/><input type="text" id="skip_element" name="skip_element" value="1" /></p>
							<p><label>Fields terminated by</label><br/><input type="text" id="delimeter" name="delimiter" value="," /></p>
							<p ><label>Fields enclosed by</label><br/><input type="text" id="enclosed" name="enclosed" value='"' /></p>
							<p ><label>Fields escaped by</label><br/><input type="text" id="escape" name="escape" value="//" /></p>
							<p><input type="submit" value="submit" /></p>
						</form>
				 	</div>	
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>js/plugins/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>js/plugins/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>
