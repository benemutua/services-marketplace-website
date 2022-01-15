<!--call the db ops to allow check for sessions-->
<?php require_once("dboperations.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Benesoftke| Find a service provider near you/ sell a service and earn from it</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--icons-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />



  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!--the jQuery CDN and my custom google div import --->
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/jquery/jquery-3.6.0.js"></script>

  <!-------import the map script---------->
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<!--import the places api then proceed
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDraFwhMImiF0rNXdFAwVaT2FXsTe9tS3o"></script> 


<!then javascript for the places autocomplete---
<script>
var searchInput = 'googleSuggestLocation';//the input field for entering the location
var autocomplete;
autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
types: ['geocode'],
});	


google.maps.event.addListener(autocomplete, 'place_changed', function () {//make the input change detectable
var near_place = autocomplete.getPlace();
document.getElementById('latInfo').value = near_place.geometry.location.lat();//make the latitude input have data
document.getElementById('longInfo').value = near_place.geometry.location.lng();//add data to longitude field
});

//only allow access to api from kenya
var autocomplete;
autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
types: ['geocode'],
componentRestrictions: {
country: "Kenya"
}//close the restriction option
});
</script><--close the places auto complete script--->
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
    
      <h1 class="logo me-auto"><a href="index.php"><img src="assets/img/favicon.png" alt="logo">enesoftKe</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <!-- <li><a class="active" href="index.php">Home |</a></li> -->
          <li><a href="index.php" class="active">Home |</a></li>
          <li><a href="about-us.php">About Us |</a></li>
          <li><a href="service-center.php">Find Service |</a></li>
          <li><a href="careers.php">Careers |</a></li>
          <li><a href="contact.php">Contact Us</a></li>
       
          <?php if(isset($_SESSION['loggedin'])): ?>
            <li class="dropdown"><a href="login.php"> <i class="fa fa-user get-started-btn account-btn" > <?php echo $_SESSION['user']; ?></i></a>
            <?php else: ?>
              <li class="dropdown"><a href="login.php"> <i class="fa fa-user get-started-btn account-btn" > My A/c</i></a>
              <?php endif; ?>
           <ul>
            <li><a href="login.php"> <i class="fa fa-user">Login</i> </a></li>
            <li><a href="changepass.php"> <i class="fa fa-user">Change Pass</i> </a></li>
              <li><a href="manageaccount.php"> <i class="fa fa-cogs">Manage A/c</i> </a></li>
              <li><a href="signout.php"> <i class="fa fa-sign-out">Sign out</i> </a></li>
              </ul>
          </li>



        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <!--<a href="#" class="get-started-btn">My Account</a>-->

    </div>
  </header><!-- End Header -->