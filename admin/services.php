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
      <p>Modify your service information.</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Service Page</a></li>
    </ul>
  </div>
  <!-- show table -->
  <div class="row">
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        <h2>View Records
          <a href="addservice.php" style="float: right;" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add New Record</a>
        </h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>First</th>
                <th>Content</th>
                <th>Second</th>
                <th>Content</th>
                <th>Third</th>
                <th>Content</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <?php 

              $showdata = new User();
              $services = $showdata->showserviceData(); 

      foreach ($services as $service) {
       
      ?>
              <tr>
                <td><?php echo $service['id']; ?></td>
                <td><?php echo $service['name']; ?></td>
                <td><?php echo $service['content']; ?></td>
                <td><?php echo $service['sname']; ?></td>
                <td><?php echo $service['scontent']; ?></td>
                <td><?php echo $service['tname']; ?></td>
                <td><?php echo $service['tcontent']; ?></td>
                <td><a href="serdelete.php?id=<?php echo $service["id"]; ?>"><button type="button"
                      class="btn btn-danger"><i class="fa fa-trash-o "></i>Delete</button>
                </td>
                <td><a href="serupdate.php?id=<?php echo $service["id"];?>"><button type="button"
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

