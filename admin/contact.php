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
          <h1><i class="fa fa-th-list"></i> Contact info </h1>
          <p>Table to display contact data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table  table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                    <th>Id</th>
                      <th>Name</th>
                      <th>Subject</th>
                      <th>Email</th>
                      <th>Message</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                     $contact = new User();
                     
                     $contactdata = $contact->ContactTable();

                     foreach($contactdata as $data){
                  
                  ?>
                      <tr>
                      <td><?php echo $data["id"]; ?></td>
                      <td><?php echo $data["name"]; ?></td>
                      <td><?php echo $data["subject"]; ?></td>
                      <td><?php echo $data["email"]; ?></td>
                      <td><?php echo $data["message"]; ?></td>
                      <td><a href="contactdel.php?id=<?php echo $data["id"]; ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash-o "></i>Delete</button>

                      </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include ('include/footer.php');?>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script>  
$(document).ready(function(){  
     $('#sampleTable').DataTable();  
});  
</script>      
