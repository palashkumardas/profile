<?php 
include('class/User.php');
$user = new User();
$user->loginStatus();
$userDetail = $user->userDetails();

include('include/header.php');
include('include/sidebar.php');

?>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Modify your facts information.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">About Page</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <?php

            $personalObj = new User();

              // Insert Record in customer table
              if (isset($_POST['submit'])) {

              $title = $_POST['title'];
              $message = $_POST['message'];
              $webaddress = $_POST['webaddress'];
              $age = $_POST['age'];
              $conclusion = $_POST['conclusion'];
              $insertData = $personalObj->personalData($title,$message,$webaddress,$age,$conclusion);

              if ($insertData==true) {
                  echo '<div id="login-alert" class="alert alert-success col-sm-12">Submit data successfully.</div>                            
                  ';
              } else {
                  echo'<div id="login-alert" class="alert alert-danger col-sm-12">Submit data fail.</div>                            
                  ';
              }
              }
              ?>
            <div class="row">
              <div class="col-md-10 offset-md-1">
              
              <form method="POST" action="">
                  <div class="row">
                    <div class="col-md-4">
                      <label>Title</label>
                      <input class="form-control" type="text" name="title" placeholder="please input" required>
                    </div>
                    <div class="col-md-4">
                      <label>Message</label>
                      <textarea class="form-control" name="message" placeholder="please input" required></textarea>
                    </div>
                    <div class="col-md-4">
                      <label>Url</label>
                      <input class="form-control" type="url" name="webaddress" placeholder="please input" required>
                    </div>
                    <div class="col-md-4">
                      <label>Age</label>
                      <input class="form-control" type="number" name="age" placeholder="please input" required>
                    </div>
             
                    <div class="col-md-8">
                      <label>Conclusion</label>
                      <textarea class="form-control" name="conclusion" placeholder="please input" required></textarea>
                    </div>
                    </div><!--end process title-->
                    
                    
                   
                    <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
<?php include ('include/footer.php');?>