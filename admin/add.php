<?php
include('class/User.php');

$user = new User();
$user->loginStatus();
$userDetail = $user->userDetails();

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
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body col-md-6 offset-3">

          <?php

          $customerObj = new User();

            // Insert Record in customer table
            if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $message = $_POST['message'];
            $picture = $_FILES['picture'];
            $insertData = $customerObj->insertData($name,  $message,  $picture);

            if ($insertData==true) {
                echo '<div class="alert alert-success" role="alert">
                You have insert data sucessfully!
              </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                Something is going wrong!
              </div>';
            }
            }
            ?>
          <div class="clear-fix">

            <form method="POST" action="" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
              </div>

              <div class="form-group">
                <label for="message">message:</label>
                <textarea row="3" class="form-control" name="message" placeholder="Enter username" required=""></textarea>
              </div>
              <div class="form-group">
                <label for="picture">Profile Image:</label>
                <input type="file" class="form-control" name="picture" required="">
              </div>
              <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
            </form>
          </div>
        </div>
        <!-- end of body -->
      </div>
    </div>
  </div>
</main>
<?php include('include/footer.php'); ?>