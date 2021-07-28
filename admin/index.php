<?php 
include('class/User.php');
$user = new User();
$errorMessage =  $user->Adminlogin();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Palash</h1>
      </div>
      <div class="login-box" style="height:450px">
     
        <form class="login-form" id="loginform" role="form" method="POST" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <?php if ($errorMessage != '') { ?>
					 <div class="alert alert-warning pt-0" role="alert">
                <?php echo $errorMessage; ?></div>                            
				<?php } ?>
					<div class="form-group">
            <label class="control-label">USEREMAIL</label>
						<input type="text" class="form-control" id="loginId" name="loginId"  value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>" placeholder="email">                                        
					</div>                                
					<div class="form-group">
            <label class="control-label">PASSWORD</label>
						<input type="password" class="form-control" id="loginPass" name="loginPass" value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>" placeholder="password">
					</div>            
					<div class="form-group">
					  <div class="utility">
              <div class="animated-checkbox">
						  <label>
						  <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["loginId"])) { ?> checked <?php } ?>> <span class="label-text">Remember Me</span>
						  </label>
              </div>
              <p class="semibold-text mb-2"><a href="forget_password.php" data-toggle="flip">Forgot Password ?</a></p>
					  </div>
					</div>
					<div class="form-group btn-container">                               
					<button type="submit" name="login" value="Login" class="btn btn-primary btn-block "><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>						  
					</div>
          <div class="form-group">
          <div class="col-md-12 control">
							<div style="padding-top:8px;"class="semibold-text mb-2" >
								Create an account! 
							<a href="register.php">
								Click 
							</a>Here. 
							</div>
          </div>						
					</form>  
        
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
  </body>
</html>