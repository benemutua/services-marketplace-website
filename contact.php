<!--import the header section-->
<?php require_once("header.php"); ?>

<!--end importing header-->








  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Contact Us</h2>
        <p>
          Not Finding what you're looking for?, Need support?,  Quick brokers? Contact us now
        </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
     

<!--CONTACT PAGE-->

      <div class="container">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Athi River(Sokoni), Mamba Building</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>support@benesoftke.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+254 7086 724 95</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form">




              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Your Message Here.." required></textarea>
              </div>
              
              <div class="text-center php-email-form mt-2 mb-3"><button type="submit" name="sendmail">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>




      <!---------------------------------------
      MAP LOCATION
      ---------------------------------------->

<h5 style="text-align:center;">Office Map Location</h5>
      <div data-aos="fade-up" style="border:3px solid green; margin-top:20px">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8038831148024!2d36.81975751415748!3d-1.292060535995458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10dedc16d5cb%3A0xcf1f28701f4ffa5d!2sLynx%20Prime%20Limited!5e0!3m2!1sen!2ske!4v1632573549167!5m2!1sen!2ske" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <div id="preloader"></div>
        </div>


    </section><!-- End Contact Section -->

  </main><!-- End #main -->





  
<!---------import footer------------>
<?php require_once("footer.php"); ?>
<!--end importing footer------------>

  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>