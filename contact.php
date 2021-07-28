<?php include ('header.php');?>
<body>

  <!-- ======= Header ======= -->
  
<?php include ('nav.php'); ?>
  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>This is contact form. Please fillup all information and submit data.</p>
        </div>

        <div>
        <iframe  style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3679.899409859312!2d89.07724521496247!3d22.73197988510098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sbn!2sbd!4v1627070502066!5m2!1sbn!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>Satkhira,Khulna,Bangladesh</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>cse.palashdas@gmail.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+8801927166288</p>
              </div>

            </div>

          </div>
   
          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="action.php" method="post" role="form" >
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control"  placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required/>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email"  placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" required/>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject"  placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject"required />
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"required></textarea>
              </div>
              <div class="form-group">
              <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Send Mail</button>
              </div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?php include ('footer.php');?>