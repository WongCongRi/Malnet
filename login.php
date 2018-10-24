<?php 
  require_once(__DIR__."/src/config.php");
  require_once(__DIR__."/src/lib/usercake/init.php");
  
  // Prevent the user visiting the logged in page if he/she is already logged in
  if (!UCUser::CanUserAccessUrl($_SERVER['PHP_SELF'])) { header("Location: account.php"); die();}
  
  $errors = array();
  $successes = array();
  global $user_settings;
  
  //Forms posted
  if(!empty($_POST))
  {    
    $username 			= sanitize(trim($_POST["username"]));
    $password 			= trim($_POST["password"]);
    $remember_choice 	= isset($_POST["remember_me"]) ? trim($_POST["remember_me"]) : "";
    
    //Perform some validation
    //Feel free to edit / change as required
    if($username == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
    }
    if($password == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
    }
  
    if(count($errors) == 0)
    {
      //A security note here, never tell the user which credential was incorrect
      if(!UCUser::UserNameExists($username))
      {
        $errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
      }
      else
      {
        $userdetails = UCUser::GetByUserName($username);
        $userdetails = new UCUser($userdetails[0], True);
        
        //See if the user's account is activated
        if($userdetails->Active() == 0)
        {
          $errors[] = lang("ACCOUNT_INACTIVE");
        }
        else
        {
          //Hash the password and use the salt from the database to compare the password.
          $entered_pass = generateHash($password, $userdetails->Password());          
          if($entered_pass != $userdetails->Password())
          {
            //Again, we know the password is at fault here, but lets not give away the combination in case of someone bruteforcing
            $errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
          }
          else
          {
          	$userdetails->UpdateRememberMe($remember_choice);
          	$userdetails->UpdateRememberMeSessionId(generateHash(uniqid(rand(), true)));          	            
          	$userdetails->updateLastSignIn();        
            
          	if($userdetails->RememberMe() == 0) {
          		global $session;
          		$session->_set("userCakeUser", $userdetails);
            }
            else if($userdetails->RememberMe() == 1)
            {
            	global $user_db;
            	$user_db->UpdateSession($userdetails->RememberMeSessionId(), $userdetails);  
            	$user_db->CreateSession($userdetails->RememberMeSessionId(), $userdetails);
            	setcookie("userCakeUser", $userdetails->RememberMeSessionId(), time() + parseLength($user_settings->RememberMeLength()), '/');
            }
            
            //Redirect to user account page
            header("Location: account.php");
            die();
          }
        }
      }
    }
  }
?> 

<!DOCTYPE html>
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
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
  <link href="http://localhost/mrf/dist/img/Malnet_logo.jpg" rel="shortcut icon" type="image/x-icon" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/red.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]-->
  <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
	* {
    		padding: 0px;
    		margin: 0px;
    		box-sizing: border-box;
    		font-family: 'Roboto', Times, Serif;
	  }

	body{
		margin: 0 auto;
    		max-width: 1924px;
    		padding: 0px;
		background: 100%;
	  }

	#Mlogo{
		box-shadow: 5px 5px 9px #777;
    		position: relative;
    		left: 50px;
		right: -10px;
   		top: 5px;
    		border-radius: 50px;
		max-width: 100%;
		height: 230px;
		width: 230px;
		margin: 0 auto;
                padding: 0px;
		clear: both;
	  }

	#rf{
		position: relative;
		left: 20px;
  		bottom: 30px;
		letter-spacing: 1px;
	}

	#rf > a{
		color: white;
	}

	#rf > a:hover{
		      color: #e45785;
	}

	.form-group > label {
		   color: white;
	}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!--<div class="login-logo">
      <a href="index.php"><?php echo $user_settings->WebsiteName() ?></a>
  </div>-->
  <!-- /.login-logo -->
  <img src="http://localhost/mrf/dist/img/Malnet.jpg" id="Mlogo"/>
  <div class="login-box-body">
    	<!--<img src="http://localhost/mrf/dist/img/Malnet.jpg" id="Mlogo"/>-->
	<p class="login-box-msg"><u>Sign in to start your session</u></p>
    
    <?php
    foreach($errors as $error) { ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $error ?>
      </div>      
	<?php } ?>    
    <?php
    foreach($successes as $success) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $success ?>
      </div>      
    <?php } ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label><input type="checkbox" id="password" name="remember_me" class="form-control" value='1'> Remember Me?</label>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	  <!--<button type="submit" class="mdl-button mdl-js-button--raised">Sign In</button>-->
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->
    <div id="rf">
    <a href="forgot-password.php"><u></u></a>
    <a href="register.php" class="text-center"><u>Register for an account</u></a>
    <br/>
  </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-red',
      radioClass: 'iradio_square-red',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
