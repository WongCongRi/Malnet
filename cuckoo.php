
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<?php 
  require_once(__DIR__."/src/config.php");
  require_once(__DIR__."/src/lib/usercake/init.php");
  if (!IsModuleEnabled("cuckoo") || !UCUser::CanUserAccessUrl($_SERVER['PHP_SELF'])){die();}
  $user = UCUser::getCurrentUser();
?> 

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $user_settings->WebsiteName() ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
  <link href="http://localhost/mrf/dist/img/Malnet_logo.jpg" rel="shortcut icon" type="image/x-icon" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-red.min.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <?php  include(__DIR__."/top-nav.php"); ?> 
  <?php  include(__DIR__."/left-nav.php"); ?> 
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>-->

    <!-- Main content -->
    <section class="content">
    
    	<!-- Line Chart row -->
		<div class="row">
		
			<!-- Left col -->
			<section class="col-lg-3 connectedSortable">
				<div class="panel panel-info">
					<div class="panel-heading">Cuckoo Host
						<div class="box-tools pull-right">
			                <button type="button" class="btn btn-box-tool" OnClick="initCuckoo()">
								<i class="glyphicon glyphicon-refresh"></i>
								<span>Refresh</span>
								</button>
			            									</div>						
					</div>
					<div class="panel-body">
						<div class="table-responsive">
						  <table class="table table-striped table-hover">
						  	<tbody>	
						  		<tr>
						  			<td><span style="font-weight: bold; color: black;">Name: </span></td>
						  			<td><span id="cuckoo-name"> Not available</span></td>	
						  		</tr>
						  		<tr>
						  			<td><span style="font-weight: bold; color: black;">Version: </span></td>
						  			<td><span id="cuckoo-version"> Not available</span></td>	
						  		</tr>
						  		<tr>
						  			<td><span style="font-weight: bold; color: black;">Link: </span></td>
						  			<td><a id="cuckoo-link" href="#" title="Cuckoo"></a></td>	
						  		</tr>		      
						    </tbody>
						  </table>
						</div>
					</div>
				</div>
			</section>	
			
			<!-- Left col -->
			<section class="col-lg-5 connectedSortable">
				<div class="panel panel-info">
					<div class="panel-heading">Machines</div>
					<div class="panel-body">
						<div class="table-responsive">
						  <table id="machines-table" class="table table-striped table-hover">
						  	<tbody>								      
						    </tbody>
						  </table>
						</div>
					</div>
				</div>
			</section>
			
			<!-- Left col -->
			<section class="col-lg-4 connectedSortable">
				<div class="panel panel-warning">
					<div class="panel-heading">Status</div>
					<div class="panel-body">
						<p id="cpu-label">CPU</p>
						<div class="progress progress active">
		                  <div id="cpu-progress" class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
		                </div>
		                <p id="disk-label">Disk</p>
						<div class="progress progress active">
		                  <div id="disk-progress" class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
		                </div>
					</div>
				</div>
			</section>		
			
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="panel panel-danger">
					<div class="panel-heading">Tasks</div>
					<div class="panel-body">
						<div class="table-responsive">
						  <table id="tasks-table" class="table table-striped table-hover">
						  	<tbody>								      
						    </tbody>
						  </table>
						</div>
					</div>
				</div>
			</section>
			
		</div>
		<!-- /.row (Line Chart row) -->	

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php  include(__DIR__."/footer.php"); ?> 
  <?php  include(__DIR__."/right-nav.php"); ?> 
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- MRF -->
<!--<script src="plugins/jQueryUpload/js/vendor/jquery.min.js"></script>-->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<!--<script src="plugins/jQueryUpload/js/vendor/jquery.ui.widget.js"></script>-->
<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<!-- Bootstrap needs to be placed AFTER jquery-ui because of tootltip conflicts -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 2.2.2 -->
<script src="plugins/chartjs/2.2.2/Chart.min.js"></script>
<!-- PACE -->
<script src="plugins/pace/pace.min.js"></script>
<!-- The main application script -->
<script src="dist/js/main.js"></script>

<script>
$(function() {
	initCuckoo();
});
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
