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
      <p>Modify your facts page.</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">About page</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        <h2>View Records
          <a href="addfacts.php" style="float: right;" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add New Record</a>
        </h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Subject_Name</th>
                <th>Count_Range</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
            <?php 

              $factObj = new User();
              $facts = $factObj->showfactData(); 

      foreach ($facts as $fact) {
       
      ?>
        <tr>
          <td><?php echo $fact['id']; ?></td>
          <td><?php echo $fact['fact_name']; ?></td>
          <td><?php echo $fact['count']; ?></td>
          <td><a href="factdelete.php?id=<?php echo $fact["id"]; ?>"><button type="button"
                      class="btn btn-danger"><i class="fa fa-trash-o "></i>Delete</button>
                </td>
                <td><a href="factupdate.php?id=<?php echo $fact["id"];?>"><button type="button"
                      class="btn btn-success"><i class="fa fa-pencil-square-o"></i>Update</button>
                </td>
        </tr>
      <?php } ?>
            </tbody>
          </table>
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
    <?php include ('include/footer.php');?>  

