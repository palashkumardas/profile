<?php 
include('class/User.php');
$user = new User();
$user->loginStatus();
$message = '';
if(!empty($_POST["update"]) && $_POST["update"]) {
	$message = $user->editpersonal();
}
$userDetail = $user->updatepersonal();
include ('include/header.php');
include ('include/sidebar.php');

?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Personal Information</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Edit Page</a></li>
        </ul>
      </div>
      <!-- start container -->
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-md-12">
              <?php if($message != '') { ?>
						<div id="login-alert" class="alert alert-success col-sm-12"><?php echo $message; ?></div>                            
					<?php } ?>
              </div><!--end message-->
                  <div class="col-md-10 offset-2">
                  <form class="form-horizontal" role="form" method="POST" action="">
                  <div class="row">
                    <div class="col-md-4">
                      <label>Title</label>
                      <input class="form-control" type="text" name="title" placeholder="please input" value="<?php echo $userDetail['title'];?>">
                    </div>
                    <div class="col-md-4">
                      <label>Message</label>
                      <textarea class="form-control" name="message" placeholder="please input" ><?php echo $userDetail['message'];?></textarea>
                    </div>
                    <div class="col-md-4">
                      <label>Url</label>
                      <input class="form-control" type="url" name="url" placeholder="please input" value="<?php echo $userDetail['url'];?>">
                    </div>
                    <div class="col-md-4">
                      <label>Age</label>
                      <input class="form-control" type="number" name="age" placeholder="please input" value="<?php echo $userDetail['age'];?>">
                    </div>
             
                    <div class="col-md-8">
                      <label>Conclusion</label>
                      <textarea class="form-control" name="conclusion" placeholder="please input" ><?php echo $userDetail['conclusion'];?></textarea>
                    </div>
                    </div><!--end process title-->

                                <button id="btn-signup" type="submit" name="update" value="update_account" class="btn btn-info"><i class="fa fa-pencil-square-o"></i>Update</button>			
                  </div>
                </form>
                        </div><!--end of form -->
                                           
                 

            </div> <!--row--> 
          </div> <!-- container tile--->
        </div>
      </div>
      <!-- end container -->
       
    </main>
    <!-- Essential javascripts for application to work-->
<?php include ('include/footer.php');?>