<?php
include('class/User.php');

$user = new User();
$message = '';
if(!empty($_POST["update"]) && $_POST["update"]) {
	$message = $user->edithome();
}
$user->loginStatus();
$userDetail = $user->updatehome();

include('include/header.php');
include('include/sidebar.php');

// Insert Record in customer table

?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Home Page</h1>
      <p>Start a beautiful journey here</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Home Page</a></li>
    </ul>
  </div>
 
<!-- table -->
<div class="row">
        <div class="col-md-6">
          <div class="tile">
          <?php if($message != '') { ?>
						<div id="login-alert" class="alert alert-success col-sm-12"><?php echo $message; ?></div>                            
					<?php } ?>
          <form method="POST" class="form-horizontal" role="form"  action="">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name"  value="<?php echo $userDetail['name'];?>">
              </div>

              <div class="form-group">
                <label for="message">message:</label>
                <textarea row="3" class="form-control" name="message" placeholder="Enter username" ><?php echo $userDetail['message'];?></textarea>
              </div>
              <button  type="submit" name="update" value="update_account" class="btn btn-info"><i class="fa fa-pencil-square-o"></i>Update</button>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
          <?php
            // Insert Record in customer table
        if(isset($_POST['change'])) {
          
            $id = $_GET['id'];
            $file = $_FILES['image'];
            $updateData = $user->homeimg($id,$file);

              if ($updateData){
                  echo '<div class="alert alert-success" role="alert">
                  Image update has completed.
                </div>';
              }else{
                  echo '<div class="alert alert-danger" role="alert">
                  Something is going wrong.
                </div>';;
              }

              }
             ?>      
                  <form method="POST" action="" enctype="multipart/form-data">                  
                  <div class="form-group">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" class="form-control" name="image" ><span><?php echo $userDetail['picture'];?></span>
                  </div>
                  <div class="form-group">
                  <button type="submit" name="change" class="btn btn-primary"  value="Submit"><i class="fa fa-pencil-square-o"></i>Change Image</button>
                  </div>
                </form>

          </div>
        </div>
</div>
<!-- table -->

</main>
<?php include('include/footer.php'); ?>