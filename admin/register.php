
<?php 
include('class/User.php');
$user = new User();
$message =  $user->register();
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
	<div class="login-box" style="height:600px; margin-bottom:50px;">
				<form id="signupform" class="login-form" role="form" method="POST" action="">	
				<h5 class="login-head"><i class="fa fa-lg fa-fw fa fa-id-card"></i> REGISTRATION FORM</h5>			
					<?php if ($message != '') { ?>
						<div class="alert alert-warning pt-0"><?php echo $message; ?></div>                            
					<?php } ?>	
					<div class="form-group">
						<label for="firstname" class="control-label">First Name*</label>
						<input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php if(!empty($_POST["firstname"])) { echo $_POST["firstname"]; } ?>" required>
					</div>
					<div class="form-group">
						<label for="lastname" class="control-label">Last Name</label>
						<input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php if(!empty($_POST["lastname"])) { echo $_POST["lastname"]; } ?>" >
					</div>					
					<div class="form-group">
						<label for="email" class=" control-label">Email*</label>
						<input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" required>
					</div>					
					<div class="form-group">
						<label for="password" class=" control-label">Password*</label>
						<input type="password" class="form-control" name="passwd" placeholder="Password" required>
					</div>								
					<div class="form-group">						                                  
					<button id="btn-signup" type="submit" name="register" value="register" class="btn btn-primary btn-block "><i class="fa fa-sign-in fa-lg fa fa-user-plus"></i> &nbsp REGISTRATION</button>			
					</div>					
					<div class="form-group">
							<div style="padding-top:5px;" class="semibold-text mb-2" >
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