<?php 
include('class/User.php');
$user = new User();
$user->loginStatus();
$message = '';
if(!empty($_POST["update"]) && $_POST["update"]) {
	$message = $user->editcv();
}
$userDetail = $user->updateresume();
include('include/header.php');
include('include/sidebar.php');

?>
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Modify your summary information.</p>
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
                      <label>Title</label>
                      <input class="form-control" type="text" name="title" placeholder="please input.." value="<?php echo $userDetail['pname'];?>" >
                    </div>
                    <div class="col-md-3">
                      <label>summary</label>
                      <textarea class="form-control" row="3"  name="summary" placeholder="please input.."><?php echo $userDetail['pmessage'];?></textarea>
                    </div>
                    <div class="col-md-3">
                      <label>City</label>
                      <input class="form-control" type="text" name="city" placeholder="please input.." value="<?php echo $userDetail['pcity'];?>" >
                    </div>
                    <div class="col-md-3">
                      <label>Mobile</label>
                      <input class="form-control" type="text" name="phone" placeholder="please input.." value="<?php echo $userDetail['pphone'];?>" >
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

