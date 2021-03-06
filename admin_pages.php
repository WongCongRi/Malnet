<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<?php 
  require_once(__DIR__."/src/config.php");
  require_once(__DIR__."/src/lib/usercake/init.php");
  if (!UCUser::CanUserAccessUrl($_SERVER['PHP_SELF'])) { die();}
  $user = UCUser::getCurrentUser();
  
  $pages 		= getPageFiles(array(__DIR__)); //Retrieve list of pages in root usercake folder
  $dbpages 		= UCPage::GetPages(); //Retrieve list of pages in pages table
  $creations 	= array();
  $deletions 	= array();
  
  //Check if any pages exist which are not in DB
  $dbpages_arr = array();
  foreach ($dbpages as $dbpage){
  	$dbpages_arr[$dbpage->Name()] = $dbpage;
  }
  foreach ($pages as $page){
  	if(!isset($dbpages_arr[$page])){
      $creations[] = $page;	
    }
  }
  
  //Enter new pages in DB if found
  if (count($creations) > 0) {
    UCPage::Create($creations);
  }
  
  if (count($dbpages) > 0){
    //Check if DB contains pages that don't exist
    foreach ($dbpages as $page){
      if(!isset($pages[$page->Name()])){
        $deletions[] = $page->Id();	
      }
    }
  }
  
  //Delete pages from DB if not found
  if (count($deletions) > 0) {
    UCPage::Delete($deletions);
  }
  
  //Update DB pages
  $dbpages = UCPage::GetPages();
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
    <section class="content-header"> 
           
      <div id='content'>
        <div id='main'>
          <h1>Pages Administration</h1>
          <div class="table-responsive"> 
            <table class="table">
              <thread>
                <tr>
                  <th>Id</th>
                  <th>Page</th>
                  <th>Access</th>
                </tr>   
              </thread>
              <tbody>       
              <?php
              //Display list of pages
              foreach ($dbpages as $page){ ?>  
                <tr>
                  <td><?php echo $page->Id() ?></td>
                  <td>
                    <a href ="admin_page.php?id=<?php echo $page->Id() ?>"><?php echo $page->Name() ?></a>
                  </td>
                  <td>
                    <?php
                    //Show public/private setting of page
                    if($page->IsPrivate() == 0){
                      echo "Public";
                    }
                    else {
                      echo "Private";	
                    }
                    ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>                
        </div>
      </div>
      
      <!-- Breadcrumb -->
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->

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
<!-- Bootstrap 3.3.6 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
