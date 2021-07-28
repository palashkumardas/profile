
<?php
include('class/User.php');

$user = new User();
$user->loginStatus();
$userDetail = $user->userDetails();
$delete=$user->resumedelete();
include('include/header.php');
include('include/sidebar.php');

// Insert Record in customer table

?>
    
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Blank Page</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
            <?php if ($delete != '') { ?>
						<div class="alert alert-warning pt-0"><?php echo $delete; ?></div>                            
					<?php } ?> 

            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include('include/footer.php'); ?>