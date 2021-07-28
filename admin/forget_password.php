<?php 
include('class/User.php');
$user = new User();
$errorMessage = '';
if(!empty($_POST['forgetpassword']) && $_POST['forgetpassword']) {
	$errorMessage =  $user->resetPassword();
}
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
				<div class="login-box">
				<form id="signupform" class="login-form" role="form" method="POST" action="">	
				<h5 class="login-head"><i class="fa fa-lg fa-fw fa fa-pencil-square"></i>PASSWORD RESET FORM</h5>			
				<div >
				<?php if ($errorMessage != '') { ?>
					<div  class="alert alert-warning pt-0" role="alert"><?php echo $errorMessage; ?></div>                            
				<?php } ?>			
					<div class="form-group">
						<label for="email" class=" control-label">Email*</label>
						<input type="email" class="form-control" id="email" name="email"  placeholder="email" required>
					</div>													
					<div class="form-group">						                                  
					<button type="submit" name="forgetpassword" value="Submit"  class="btn btn-primary btn-block "><i class=" fa-lg fa fa-pencil-square-o"></i> &nbsp RESET PASSWORD</button>			
					</div>					
					<div class="form-group">
							<div style="padding-top:10px;" class="semibold-text mb-2" >
								If You've already an account! 
							<a href="index.php">click 
							</a>Here
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