<?php 
include('class/User.php');
$user = new User();
$message = '';
if(!empty($_POST["update"]) && $_POST["update"]) {
	$message = $user->editservice();
}
$user->loginStatus();
$userDetail = $user->updateservice();
include('include/header.php');
include('include/sidebar.php');

?>
 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Modify your skills information.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">About Page</a></li>
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
                  <div class="row ">
                    <div class="col-md-6">
                      <label>Name</label>
                      <input class="form-control" type="text" name="name" placeholder="please input.." value="<?php echo $userDetail['name'];?>">
                    </div>
                    <div class="col-md-6">
                      <label>Content</label>
                      <textarea class="form-control" row="3" name="content" placeholder="please input.." ><?php echo $userDetail['content'];?></textarea>
                    </div>
                    <div class="col-md-6">
                      <label>Name</label>
                      <input class="form-control" type="text" name="sname" placeholder="please input.." value="<?php echo $userDetail['sname'];?>">
                    </div>
                    <div class="col-md-6">
                      <label>Content</label>
                      <textarea class="form-control" row="3" name="scontent" placeholder="please input.." ><?php echo $userDetail['scontent'];?></textarea>
                    </div>
                    <div class="col-md-6">
                      <label>Name</label>
                      <input class="form-control" type="text" name="tname" placeholder="please input.." value="<?php echo $userDetail['tname'];?>">
                    </div>
                    <div class="col-md-6">
                      <label>Content</label>
                      <textarea class="form-control" row="3" name="tcontent" placeholder="please input.." ><?php echo $userDetail['tcontent'];?></textarea>
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

