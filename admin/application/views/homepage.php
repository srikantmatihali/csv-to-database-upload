<?php
//echo 'login';die;
//print_r($getparam);die;
//
/*foreach($mapdata1 as $table)
{
												$id=$table->id;
												$pathdata=$table->pathdata;
												$popupClass=$table->popupClass;
												$degree=$table->degree;
												$inventoryName=$table->inventoryName;
												$inventoryClass=$table->inventoryClass;
												$inventorypageClass=$table->inventorypageClass;
												$characterClass=$table->characterClass;
												$charInvClass=$table->charInvClass;
												$popuptime=$table->popuptime;											
												$qstart=$table->qstart;
												$qend=$table->qend;
												$section=$table->section;
												$continent=$table->continent;
												$title=$table->title;
												$status	=$table->status	;
}*/
?>
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
                            <div class="box">
                                <div class="box-header">
                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
									<div class="row">
									<!--<div class="col-xs-6"><div id="example1_length" class="dataTables_length">
									<label>
									<select size="1" name="example1_length" aria-controls="example1">
									<option value="10" selected="selected">10</option><option value="25">25</option>
									<option value="50">50</option><option value="100">100</option>
									</select> records per page
									</label>
									</div>
									</div>
									<div class="col-xs-6"><div class="dataTables_filter" id="example1_filter">
									<label>Search: <input type="text" name="" aria-controls="example1"></label>
									</div>
									</div>-->
									</div>
									<!--form here-->
									<div class="">
<form action="http://localhost/infosys/admin/logincheck/" class="image_upload margin_top editform" accept-charset="ISO-8859-1" id="" method="post" enctype="multipart/form-data">
									
									
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" value="" placeholder="username">
                                        </div>
										<div style="height:20px;"></div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="password" name="password" class="form-control" id="exampleInputEmail1" value="" placeholder="password">
                                        </div>
									
										



                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
									</form>
									</div>									
									<div class="row">
									<div class="col-xs-6">
									<!--<div class="dataTables_info" id="example1_info">
									Showing 1 to 10 of 57 entries
									</div>-->
									</div>
									
									<div class="col-xs-6">
									<div class="dataTables_paginate paging_bootstrap">
									</div></div></div></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>

                <!-- Main content -->
                <section class="content">


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