<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<?php 
  require_once(__DIR__."/src/config.php");
  require_once(__DIR__."/src/lib/usercake/init.php");
  if (!UCUser::CanUserAccessUrl($_SERVER['PHP_SELF'])){die();}
  $user = UCUser::getCurrentUser();
?> 

<?php 
  $filters = array();
  if (isset($_GET["tag"])) {
  	$filters["tag"] = $_GET["tag"];
  }
?>

<html lang="en">
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
  <link href="http://localhost/mrf/dist/img/Malnet_logo.jpg" rel="shortcut icon" type="image/x-icon" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">

  <!-- Generic page styles -->
  <link rel="stylesheet" href="plugins/jQueryUpload/css/style.css">
  <!-- blueimp Gallery styles -->
  <link rel="stylesheet" href="plugins/jQueryUpload/css/blueimp-gallery.min.css">
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="plugins/jQueryUpload/css/jquery.fileupload.css">
  <link rel="stylesheet" href="plugins/jQueryUpload/css/jquery.fileupload-ui.css">
  <!-- CSS adjustments for browsers with JavaScript disabled -->
  <noscript><link rel="stylesheet" href="plugins/jQueryUpload/css/jquery.fileupload-noscript.css"></noscript>
  <noscript><link rel="stylesheet" href="plugins/jQueryUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
  <!-- jqPagination styles -->
  <link rel="stylesheet" href="plugins/jQueryUpload/css/jqpagination.css" />	
  <!-- tags -->
  <link rel="stylesheet" type="text/css" href="plugins/jQueryUpload/css/tagmanager.css" />
  <!-- Pace style -->
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">
    .table-responsive {
		min-height: 400px !important;
	}
	
	ul#dropdown-item-actions,
	ul#dropdown-item-actions {
	    z-index: 10000;
	}
 
     *{
         margin: 0px;
         padding: 0px;
         box-sizing: border-box;
      }

     body{
		margin: 0 auto;
    		max-width: 1924px;
    		padding: 0px;
		background: 100%;
	  }
 
     .content-wrapper{
	    background-image: linear-gradient(to bottom right, #4ffcc5, #35fdf3);
            background-attachment: fixed;
            background-repeat: no-repeat;
 	    background-size: cover;
            background-position: center;
         }

     .content{
               padding: 20px 50px;
	       color: black;
	     }

     h1{
 	 font-size: 70px;
	 font-weight: 500;
         font-family: 'Roboto', sans-serif;
       }

     h2{
	 font-size: 40px;
         font-weight: 500;
         font-family: 'Open Sans', sans-serif;
       }

     .content p{
         width: 100%;
         margin-right: 5px;
         font-family: 'Lato', sans-serif;
         font-size: 18px;
         letter-spacing: 0.5px;
      }

     #logo{
            box-shadow: 9px 7px 9px #595959;
            border-radius: 50px;
            max-width: 100%;
          }
  </style>
  
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <?php  include(__DIR__."/top-nav.php"); ?> 
    <?php  include(__DIR__."/left-nav.php"); ?> 
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    <!-- Main content -->
    <header class="content">
    <h1>About</h1>
    <br/>
    <img src="http://localhost/mrf/dist/img/Malnet.jpg" id="logo"/>
    <br/><br/>
    <article>
    <h2><u>About us</u></h2>
    <section>
    <aside>
    <p>Malnet serves as a web application which is able to automate malware analysis of any given payload.</p>
    <p>We utilise the open source tool, Cuckoo, for our scanning/reporting engine to determine the malicious nature of the payload.</p>
    <p>Malware reporting will be done using STIX format with key constructs for clearer presentation.</p>
    </aside>
    </section>
    </article>
	<!-- Your Page Content Here -->
	<!--<div class="panel panel-info">
		<div class="panel-heading">Repository Information</div>
	</div>-->
    </header>
    </div>
    <?php  include(__DIR__."/footer.php"); ?> 
    <?php  include(__DIR__."/right-nav.php"); ?>
    </div>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- TinyMCE -->
<script src="plugins/tinymce/js/tinymce/tinymce.min.js"></script>

<!-- MRF -->
<!--<script src="plugins/jQueryUpload/js/vendor/jquery.min.js"></script>-->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<!--<script src="plugins/jQueryUpload/js/vendor/jquery.ui.widget.js"></script>-->
<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="plugins/jQueryUpload/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="plugins/jQueryUpload/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="plugins/jQueryUpload/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!--<script src="plugins/jQueryUpload/js/bootstrap.min.js"></script>-->
<!-- blueimp Gallery script -->
<script src="plugins/jQueryUpload/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="plugins/jQueryUpload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="plugins/jQueryUpload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="plugins/jQueryUpload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="plugins/jQueryUpload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="plugins/jQueryUpload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="plugins/jQueryUpload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="plugins/jQueryUpload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="plugins/jQueryUpload/js/jquery.fileupload-ui.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->

<!-- Bootstrap 3.3.6 -->
<!-- Bootstrap needs to be placed AFTER jquery-ui because of tootltip conflicts -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- jqPagination scripts -->
<script src="plugins/jQueryUpload/js/jquery.jqpagination.js"></script>
<!-- tags -->
<script type="text/javascript" src="plugins/jQueryUpload/js/tagmanager.js"></script>
<!-- PACE -->
<script data-pace-options='{"ajax":false,"document":false,"eventLag":false,"startOnPageLoad":false}' src="plugins/pace/pace.min.js"></script>
<!-- The main application script -->
<script src="dist/js/main.js"></script>

<script>
$(function() {
	var filters = <?php echo json_encode($filters) ?>;
	initRepo(filters);
	//Uncomment this for auto-refresh, though this isn't recommended.
	//setInterval(refreshRepo, 5000);
});
</script>
</body>
</html>
