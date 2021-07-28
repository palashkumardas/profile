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
      <p>Modify your experience information.</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Resume Page</a></li>
    </ul>
  </div>
  <!-- show table -->
  <div class="row">
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        <h2>View Records
          <a href="addexperiance.php" style="float: right;" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add New Record</a>
        </h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Designation</th>
                <th>Duration</th>
                <th>Organization</th>
                <th>Summary</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <?php 

              $showdata = new User();
              $datainfo = $showdata->showexpdata();

                foreach ($datainfo as $data) {
       
                ?>
              <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['exname']; ?></td>
                <td><?php echo $data['extime']; ?></td>
                <td><?php echo $data['eorg']; ?></td>
                <td><?php echo $data['eduty']; ?></td>
                <td><a href="expdelete.php?id=<?php echo $data["id"]; ?>"><button type="button"
                      class="btn btn-danger"><i class="fa fa-trash-o "></i>Delete</button>
                </td>
                <td><a href="expupdate.php?id=<?php echo $data["id"];?>"><button type="button"
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