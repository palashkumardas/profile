<?php
include ('class/class.php');

$obj=new User();

$userDetails=$obj->showhomedata();

include ("header.php");

?>
<body>

  <!-- ======= Header ======= -->
<?php include ("nav.php"); ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center" data-aos="zoom-in" data-aos-delay="100">
      <h1><?php echo $userDetails['name'];?></h1>
      <h2><?php echo $userDetails['message'];?></h2>
      <a href="about.php" class="btn-about">About Me</a>
    </div>
  </section><!-- End Hero -->

 <!-- footer -->

 <?php
 include ("footer.php");
 ?>