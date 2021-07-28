<?php include ('class/User.php');
include ('include/header.php');
include ('include/sidebar.php');

$user = new User();

?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Data Table</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active"><a href="#">Profile</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Status</th>
                      <th>action</th>

                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $users = $user->getDataTable();
                  foreach ($users as $data){
                    ?>
                      <tr>
                      <td><?php echo $data["first_name"]; ?></td>
                      <td><?php echo $data["email"]; ?></td>
                      <td><?php echo $data["mobile"]; ?></td>
                      <td><?php echo $data["status"]; ?></td>
                      <td><a href="detail.php"><button type="button" class="btn btn-primary">Detail</button>
</td>

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
