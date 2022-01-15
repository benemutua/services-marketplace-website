<!--import the header-->

<?php require_once("header.php"); ?>
<!--end importing header-->






 <!-- ======= Hero Section ======= -->
 <section id="hero" class="d-flex justify-content-center align-items-center">
<div class="container position-relative">


<div class="heroAdvDiv"><!--start first block of hero row-->
<p><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Pinned Note</p>
<span class="shakes">Imagine getting connected to a verified service provider just by click of a button?</span><br>


<a href="service-center.php" class="btn-get-started"><i class="fa fa-link"></i> Hook me up!</a>
<a href="manageaccount.php" class="btn-get-started"><i class="fa fa-usd"></i> I'm Selling a service</a>

</div><!--end first block of hero row-->



<div class="heroSearchDiv"><!--the second block of hero row-->
<h2 data-aos="zoom-in" data-aos-delay="100">What are you looking for? <br> Lets link you to the service provider near you <i class="fa fa-arrow-circle-o-down"></i> </h2>

<div class="findService"><!--start the search area--->

<div class="input-group">
<input type="text" name="" class="form-control" placeholder="Service looking for, eg Mechanic"> &nbsp;
<input type="text" name="" class="form-control" placeholder="Location">
<button class="btn btn-primary ri-search-line"> </button>
</div>
</div><!--end the serch index-->
</div><!--end the second block of hero row-->


</div>
</section><!-- End Hero -->



<main id="main"><!--the main body part starts here--->
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

//open the hanging window only once
if(sessionStorage.getItem("hangingWindow")!=='true'){
setTimeout(function(){ $("hangingWindow").show();
hang.classList.remove("hidden");
closeHang.classList.remove("hidden");
 }, 3000); //sho the window after 3 seconds
//only allow the modal to show only once
sessionStorage.setItem("hangingWindow", "true");
}



//now close window if the span is clicked
closeHang.addEventListener('click', function(){
hang.classList.add("hidden");
});

//let the window close itselft after 10secs 
setTimeout(function(){
hang.classList.add("hidden");
closeHang.classList.add("hidden");
},15000);

});

</script>
<!---end hanging window-->






<!---------the marquee texts------------------->
<div class="home-marquee-texts">
<span> <marquee width="70%" direction="left">
Start earning online by posting your professional service or business. Let people notice you online by your location
</marquee>
<a href="signup.php" class="btn btn-success">Sign Up To Enroll !</a>
</span>
</div>
<!------end marquee texts---------------------->




<!-------------------------------------------------------------------
the div just after hero
--------------------------------------------------------------------->
<div class="home-welcome-main">

<div class="home-bg-icon-div justify-content-center align-items-center"><!--the left side with bg image-->
<i class="ri-global-fill"></i>

<div class="home-bg-icon-div-texts"><!--the texts div insode the bg div-->

<h2>"The bread is too big, lets all have a slice!"</h2>

<p data-aos="zoom-in" data-aos-delay="120">What More Than Bringing a Client To Your Doorstep?</p>
<h4 class="mt-2" data-aos="zoom-in" data-aos-delay="150"> Let's give your business a national accessibility!</h4>

</div><!--end the texts--->
</div><!--end the welcome bg banner div--->

<div class="home-welcome-note"><!--the right side column with welcome note------------->
<i class="ri-hand-heart-line"></i>

<h5 data-aos="zoom-in" data-aos-delay="100">Welcome Our Esteemed Customer</h5>

<p>We are glad that you found Us</p>
<p class="mt-2"> benesoftke is a platform for All! 
Where people can advertise their hustles, and meet clients online. 
The site is supported by Google Maps meaning you can search for a service by geo location most especially close to you.</p>

<h5 class="mt-2"><span class="fa fa-question-circle-o"></span> Quick Links?</h5>
<p> Have a question? Find out from our Frequently asked questions
 <a href="faqs.php">Here..</a> . More? Contact us on 
<a href="mailto: support@benesoftke.co.ke"> Support@benesoftke.co.ke</a>
</p>
</div><!--end the welcome note div--->

</div>
<!---end the div after hero----------------------------------------------->










<!------------------------------------------------------------------
GOOGLE ADS WINDOW-------------------------------------------------->

<div class="homeGoogleAds mb-5 mt-3">
Advertisement
</div>
<!----------------------END GOOGLE ADS WINDOW----------------------->


















<div class="container text-center">
<div class="row mx-auto my-auto justify-content-center">
<div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">

<div class="carousel-inner" role="listbox"><!--carousel inner starts--> 


<div class="carousel-item active">
 <div class="card justify-content-center align-items-center" style="background: url(assets/img/customer-care.jpg); background-size:cover;">
<h4 class="carouselHClass">Get an Expert Advise</h4>

<h4 class="carouselHClass">Do you want us to better publicise your business?</h4>

<p><i class="bi bi-phone"></i> Call Us Today!</p>
</div>
</div>

<?php 
$getVerified=mysqli_query($link,"SELECT * FROM professionalstable WHERE verification='verified' AND status='active' LIMIT 20");
if(mysqli_num_rows($getVerified)>0): ?>
<?php while($rowProfessional=mysqli_fetch_assoc($getVerified)): //now list 20 verified personales ?>
<div class="carousel-item">
<div class="card">

<div class="field-speciality-div"><!--list the business here--->


<div class="field-speciality-block1">

<?php  $resultGetImage=mysqli_query($link, "SELECT * FROM images WHERE image_category='profile' AND unique_owner='".$rowProfessional['user']."' ");
if(mysqli_num_rows($resultGetImage)>0): ?>
<?php while($rowImage=mysqli_fetch_assoc($resultGetImage)): ?>
<!--if an image is found, show it-->
<?php echo "<img src='uploads/profiles/".$rowImage['image_name']."' alt='logo'>";?>
<?php endwhile; ?><!--end looping through images if any found-->
<?php else: ?><!--if there is no image found show empty-->
<img src="uploads/profiles/defaultimage.jpg" alt="logo">
<?php endif; ?>

</div>


<div class="field-speciality-block2">
  
<p><?php echo $rowProfessional['title']; ?> <?php echo $rowProfessional['first_name']; ?> 
<?php echo $rowProfessional['other_names']; ?> <i class="fa fa-check-circle-o">verified</i></p>

<h6><?php echo $rowProfessional['field']; ?></h6>
<h2>Services:</h2>

<h5><i class="fa fa-podcast"></i> <?php echo $rowProfessional['speciality']; ?> </h5>

<h2>Location:</h2>
<h5><i class="fa fa-map-marker"></i> <?php echo $rowProfessional['location']; ?></h5>

<a href="#" class="badge bg-success"><i class="fa fa-sign-out"></i> View More..</a>

</div>
</div><!--end b/s listing--->

</div><!--end the card div-->
</div><!--end the carousel item div-->
<?php endwhile; //end the while loop ?>




<?php else: ?><!--if no verified account, show more-->
  <div class="carousel-item">
<div class="card justify-content-center align-items-center">
<a href="service-center.php" class="get-started-btn"><i class="fa fa-arrow-circle-o-right"></i> Go to services..</a>
</div>
</div>
<?php endif; ?><!--end the loop checkers--->


</div><!--carouse;l inner ends-->

<a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
<span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span>
</a>

<a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
<span class="fa fa-arrow-circle-o-right" aria-hidden="true"></span>
</a>
</div>
</div>
</div>

<script>
let items = document.querySelectorAll('.carousel .carousel-item')

items.forEach((el) => {
const minPerSlide = 2
let next = el.nextElementSibling
for (var i=1; i<minPerSlide; i++) {
if (!next) {
// wrap carousel by using first child
	next = items[0]
	}
let cloneChild = next.cloneNode(true)
el.appendChild(cloneChild.children[0])
next = next.nextElementSibling
}
})
</script>






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