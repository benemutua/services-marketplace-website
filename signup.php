<!--call the db ops to allow check for sessions-->
<?php require_once("dboperations.php"); 
if(isset($_SESSION['loggedin'])){
  header("location: manageaccount.php");
exit;
}
?>



<!--import the header section-->
<?php require_once("header.php"); ?>
<!--end importing header-->


<div class="breadcrumbs"></div>
<h5 style="color:green; text-align:center;">Sign Up</h5>












<div class="loginCard">

<!--=======================================================
    SUCCESS AND ERROR MESSAGES
    ========================================================-->
    <?php if (isset($_SESSION['message'])): ?>
    <div class="cast">
      <?php 
          echo $_SESSION['message']; 
          unset($_SESSION['message']);
      ?>
      </div>
    <?php endif ?>
      
          <!--error message on form validation-->
               <?php if (isset($_SESSION['err'])): ?>
    <div class="err">
      <?php 
          echo $_SESSION['err']; 
          unset($_SESSION['err']);
      ?>
      </div>
    <?php endif ?><!--------------end the session messages part------->



<!-----------start the form---->
<form action="dboperations.php" method="post">

<label for="">Username</label>
<div class="input-group mb-3">
  <input type="text" name="userName" value="" class="form-control" placeholder="Enter username">
</div>


<label for="">Email</label>
<div class="input-group mb-3">
  <input type="email" name="email" value="" class="form-control" placeholder="Email address">
</div>


<label for="">Password</label>
<div class="input-group mb-3">
   <input type="password" name="password" value="" class="form-control" placeholder="Enter password(atleast 8 characters)">
</div>

<label for="">Confirm Password</label>
<div class="input-group mb-3">
    <input type="password" name="confPassword" value="" class="form-control" placeholder="Confirm password">
</div>


<button type="submit"  name="signupBtn" class="btn btn-success fa fa-sign-out">Sign Up</button>
<p>Already have an account? <a href="login.php">Login</a></p> 


</form><!------------end the form-------->


</div>




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