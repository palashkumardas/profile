<?php 
include ('class/class.php');

$obj  = new User();
$aboutdetails = $obj->showaboutdata();
include ("header.php");
?>

<body>
<?php include ("nav.php"); ?>
  
  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <p>HI! Every one this about page.Here i shortly describe about myself.</p>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content">
            <h3><?php echo $aboutdetails['title'];?></h3>
            <p class="font-italic">
            <?php echo $aboutdetails['message'];?>
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="icofont-rounded-right"></i> <strong>Birthday:</strong> 1 May 1995</li>
                  <li><i class="icofont-rounded-right"></i> <strong>Website:</strong><?php echo $aboutdetails['url'];?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Phone:</strong> +8801927166288</li>
                  <li><i class="icofont-rounded-right"></i> <strong>City:</strong>Satkhira,khulna,Bangladesh.</li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="icofont-rounded-right"></i> <strong>Age:</strong><?php echo $aboutdetails['age'];?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Degree:</strong> Bsc in CSE</li>
                  <li><i class="icofont-rounded-right"></i> <strong>PhEmailone:</strong> cse.palashdas@gmail.com</li>
                  <li><i class="icofont-rounded-right"></i> <strong>Freelance:</strong> Available</li>
                </ul>
              </div>
            </div>
            <p><?php echo $aboutdetails['conclusion'];?></p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Skills</h2>
          <p>Welcome to my skills infomation.</p>
        </div>

        <div class="row skills-content">

          <div class="col-lg-6">
            <?php 
            //$skill= new User();
            $skilldata = $obj->showskillData();
            
            foreach($skilldata as $data){
            ?>
            <div class="progress">
              <span class="skill"><?php echo $data['title'];?> <i class="val"><?php echo $data['count'];?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $data['count'];?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <?php }?>
          </div><!--end of col-->

          <div class="col-lg-6">

            <div id="img">
            <img src="assets/img/skill.png"  alt="" class="img-fluid">
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Facts</h2>
          <p>Welcome to my facts information.</p>
        </div>

        <div class="row counters">
          <?php
           
           $factdetails = $obj->showfactData();

           foreach($factdetails as $data){
          
          ?>
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php echo $data['count'];?></span>
            <p><?php echo $data['fact_name'];?></p>
          </div>
           <?php } ?>
        </div>

      </div>
    </section><!-- End Facts Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testimonials</h2>
          <p>Welcome to testimonials information.</p>
        </div>

        <div class="owl-carousel testimonials-carousel">
          <?php 
            $testdetails = $obj->showtestmonialData();
            
            foreach($testdetails as $data){


          ?>
          <div class="testimonial-item">
            <img src="<?php echo 'admin/images/'. $data['picture'];?>" class="testimonial-img" alt="">
            <h3><?php echo $data['name'];?></h3>
            <h4><?php echo $data['designation'];?></h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              <?php echo $data['content'];?>
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
          <?php } ?>

        </div>

      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->

<?php include("footer.php");?>