<!--import the header-->

<?php require_once("header.php"); ?>
<!--end importing header-->



<main id="main">




<!--the hanging window on the header-->
<div class="hangingWindow hidden">
<span class="closeHang hidden">&times;</span>

<h6 style="color:#18d26e; text-align:center;">ATTENTION!!</h6>
<hr>
<p>Find out how you can keep your AD highly ranked on our website. Gain the most from your listing. See ideas from the FAQs Page
  <a href="">Here..</a>
</p>


</div>
<script>
$(document).ready(function(){
var hang=document.querySelector(".hangingWindow");
var closeHang=document.querySelector(".closeHang");
setTimeout(function(){
//now remove the hidden class from window after 2 secs
hang.classList.remove("hidden");
closeHang.classList.remove("hidden");
},1000);//start the window after 2 seconds


//now close window if the span is clicked
closeHang.addEventListener('click', function(){
  hang.classList.add("hidden");
});

//let the window close itselft after 10secs 
setTimeout(function(){
  hang.classList.add("hidden");
closeHang.classList.add("hidden");
},10000);

});

</script>
<!---end hanging window-->

















<div class="breadcrumbs">
<h5>About Us</h5>
</div>


<!------------------------------------------------------------------
GOOGLE ADS WINDOW-------------------------------------------------->

<div class="homeGoogleAds mb-5 mt-3">
Advertisement
</div>
<!----------------------END GOOGLE ADS WINDOW----------------------->







    <!-- ======= ABOUT US Section ======= -->
    <section id="events" class="events">
      <div class="container">

        <div class="row">
          <div class="col-md-6 d-flex align-items-stretch">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/about.png" alt="about us">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="">About Us_</a></h5>
            
            
            
            <p class="card-text">Benesofke was founded to help people to quickly locate a service provider near them and under one roof.
              <br><br>
              With a big pool, you can easily identify the best based on different metrics like pricing, other customers rating,
              and responsiveness. Happy search

            </p>
            
            
            
            
              </div>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch">
            <div class="card">
              <div class="card-img">
                <img src="assets/img/marketing.jpeg" alt="marketing Strategies">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="">Why Us?</a></h5>
             
            <h5>Our Marketing Strategy</h5>
            <p>Brand marketing is a big engine behind success on benesoftKe platform. From optimizing our website on the Search engine
            to Social media updates. This means every update is automatically replicated on our marketing to capture the attention of potential clients.</p>

            <h5>Cheap Advertisement</h5>
            <p>In exchange to the wide audience we have, you only have to pay some few coins to and you are up on the market. </p>
            </div>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Events Section -->




<!------------------------------------------------------------------
GOOGLE ADS WINDOW-------------------------------------------------->

<div class="homeGoogleAds mb-5 mt-3">
Advertisement
</div>
<!----------------------END GOOGLE ADS WINDOW----------------------->



    
<!---import services-->
<?php require_once("service-portal.php") ?>

</main><!-- End #main -->

<!---------import footer------------>
<?php require_once("footer.php"); ?>
<!--end importing footer------------>



  <div id="preloader"></div>
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