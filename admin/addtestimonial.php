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
          <p>Modify your testimonials information.</p>
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

                $testObj = new User();

                // Insert Record in customer table
                if (isset($_POST['submit'])) {

                $name = $_POST['name'];
                $designation = $_POST['designation'];
                $message = $_POST['message'];
                $picture = $_FILES['picture'];
                $insertData = $testObj->addtestimonialData($name,$designation,$message,$picture);

                if ($insertData==true){
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
            <div class="row">
              <div class="col-md-10 offset-md-1">
              
              <form method="POST" action="" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Title</label>
                      <input class="form-control" type="text" name="name" placeholder="please input.." required >
                    </div>
                    <div class="col-md-6">
                      <label>Designation</label>
                      <input class="form-control" type="text" name="designation" placeholder="please input.." required >
                    </div>
                    <div class="col-md-6">
                      <label>Message</label>
                      <textarea  name="message" rows="4" cols="50"></textarea>
                    </div>
                    <div class="col-md-6">
                      <label>Picture</label>
                      <input class="form-control" type="file" name="picture" placeholder="please input.." required >
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

