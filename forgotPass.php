<!--import the header section-->
<?php require_once("header.php"); ?>
<!--end importing header-->


<div class="breadcrumbs2"></div>


<div class="loginCard">
<form action="" method="post">



<img src="assets/img/favicon.png" alt="logo">

<br>
<label for="">Username</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text fa fa-user" id="basic-addon1"></span>
  </div>
  
  <input type="text" name="username" value="" class="form-control" placeholder="Enter Username" aria-label="Username" aria-describedby="basic-addon1">
</div>

<label for="">Email Address</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text fa fa-envelope" id="basic-addon1"></span>
  </div>
   <input type="email" name="password" value="" class="form-control" placeholder="Enter Password" aria-label="Username" aria-describedby="basic-addon1">
</div>


<button type="submit" name="resetPass" class="btn btn-danger fa fa-trash"> Reset Pass</button>
<p>Go to Login <a href="login.php">Sign In</a></p> 


</form>


</div>



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>