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
          <?php

          $serviceObj = new User();

            // Insert Record in customer table
            if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $content= $_POST['content'];
            $sname = $_POST['sname'];
            $scontent= $_POST['scontent'];
            $tname = $_POST['tname'];
            $tcontent= $_POST['tcontent'];
            $insertData = $serviceObj->serviceData($name,$content,$sname,$scontent,$tname,$tcontent);

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
              
              <form action="" method="POST">
                  <div class="row ">
                    <div class="col-md-6">
                      <label>Service : Name</label>
                      <input class="form-control" type="text" name="name" placeholder="please input.." required>
                    </div>
                    <div class="col-md-6">
                      <label>Service : Content</label>
                      <textarea class="form-control" row="3" name="content" placeholder="please input.." required></textarea>
                    </div>
                    <div class="col-md-6">
                      <label>Service : Name</label>
                      <input class="form-control" type="text" name="sname" placeholder="Please input content for service no two" required>
                    </div>
                    <div class="col-md-6">
                      <label>Service : Content</label>
                      <textarea class="form-control" row="3" name="scontent" placeholder="Please input content for service no two" required></textarea>
                    </div>
                    <div class="col-md-6">
                      <label>Service : Name</label>
                      <input class="form-control" type="text" name="tname" placeholder="Please input content for service no three" required>
                    </div>
                    <div class="col-md-6">
                      <label>Service : Content</label>
                      <textarea class="form-control" row="3" name="tcontent" placeholder="Please input content for service no three" required></textarea>
                    </div>
                    </div><!--end process title--> 
                    
                    
                   
                    <button class="btn btn-primary" type="submit"name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>

    <?php include ('include/footer.php');?>  

