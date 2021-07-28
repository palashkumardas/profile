<?php 
include ('class/class.php');
$user = new User();

include ("header.php");
?>
<body>

  <!-- ======= Header ======= -->
 <?php include ("nav.php");?>

  <main id="main">

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Resume</h2>
          <p>Welcome to my resume.</p>
        </div>

        <div class="row">
      
          <div class="col-lg-6">
            <h3 class="resume-title">Sumary</h3>
                  <?php

                    $cvdata = $user->showcvData();

                    foreach($cvdata as $data){

                    ?>
            <div class="resume-item pb-0">
              <h4><?php echo $data['pname'];?></h4>
              <p><em><?php echo $data['pmessage'];?></em></p>
              <p>
              <ul>
                <li><?php echo $data['pcity'];?></li>
                <li><?php echo $data['pphone'];?></li>
                <li>cse.palashdas@gmail.com</li>
              </ul>
              </p>
            </div>
            <?php }?>

            <h3 class="resume-title">Education</h3>
                  <?php

                  $eddata = $user->showedData();

                  foreach($eddata as $data){

                  ?>
            <div class="resume-item">
              <h4><?php echo $data['ename'];?></h4>
              <h5><?php echo $data['etime'];?></h5>
              <p><em><?php echo $data['eschool'];?></em></p>
              <p><?php echo $data['emessage'];?></p>
            </div>
            <?php } ?>
          </div>

          <div class="col-lg-6">
            <h3 class="resume-title">Professional Experience</h3>
                    <?php 
                    
                    $expdata = $user->showexpData();

                    foreach($expdata as $data){
                    
                    
                    ?>
            <div class="resume-item">
              <h4><?php echo $data['exname'];?></h4>
              <h5><?php echo $data['extime'];?></h5>
              <p><em><?php echo $data['eorg'];?></em></p>
              <p>
              <ul>
                <li><?php echo $data['eduty'];?></li>
                
              </ul>
              </p>
            </div>
                    <?php }?>
          </div>
        </div>

      </div>
    </section><!-- End Resume Section -->

  </main><!-- End #main -->

 <?php include ("footer.php");?>