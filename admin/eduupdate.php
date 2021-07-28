<?php 
include('class/User.php');
$user = new User();
$user->loginStatus();
$message = '';
if(!empty($_POST["update"]) && $_POST["update"]) {
	$message = $user->editedu();
}
$userDetail = $user->updateedu();
include('include/header.php');
include('include/sidebar.php');

?>
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Modify your education information.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Resume Page</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
      
          <div class="tile">
          <?php if($message != '') { ?>
						<div id="login-alert" class="alert alert-success col-sm-12"><?php echo $message; ?></div>                            
					<?php } ?>
            <div class="row">
              <div class="col-md-10 offset-md-1">
              
              <form action="" method="POST">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Degree</label>
                      <input class="form-control" type="text" name="degree" placeholder="please input.." value="<?php echo $userDetail['ename'];?>" >
                    </div>
                    <div class="col-md-3">
                      <label>Duration</label>
                      <input class="form-control" type="text" name="duration" placeholder="please input.." value="<?php echo $userDetail['etime'];?>" >
                    </div>
                    <div class="col-md-3">
                      <label>Institute</label>
                      <input class="form-control" type="text" name="inst" placeholder="please input.." value="<?php echo $userDetail['eschool'];?>" >
                    </div>
                    <div class="col-md-3">
                      <label>Summary</label>
                      <textarea class="form-control" row="3"  name="summary" placeholder="please input.."><?php echo $userDetail['emessage'];?></textarea>
                    </div>
                    </div><!--end process title--> 
                    <button id="btn-signup" type="submit" name="update" value="update_account" class="btn btn-info"><i class="fa fa-pencil-square-o"></i>Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>

    <?php include ('include/footer.php');?>  

