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
      <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      <p>Modify your home page.</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Home page</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        <h2>View Records
          <a href="add.php" style="float: right;" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add New Record</a>
        </h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
                <th>Logo</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
            <?php 

              $customerObj = new User();
              $customers = $customerObj->displayData(); 

      foreach ($customers as $customer) {
       
      ?>
        <tr>
          <td><?php echo $customer['id']; ?></td>
          <td><?php echo $customer['name']; ?></td>
          <td><?php echo $customer['message']; ?></td>
          <td><img src="<?php echo 'images/'. $customer['picture'] ?>" width="80px"></td>
          <td><a href="delete.php?id=<?php echo $customer["id"]; ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash-o "></i>Delete</button>
</td>
          <td><a href="update.php?id=<?php echo $customer["id"];?>"><button type="button" class="btn btn-success"><i class="fa fa-pencil-square-o"></i>Update</button>
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

<?php include('include/footer.php'); ?>