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
<h5 style="color:green; text-align:center;">Sign In</h5>






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




<form action="dboperations.php" method="post">

<label for="">Username</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text fa fa-user" id="basic-addon1"></span>
  </div>
  
  <input type="text" name="userName" value="" class="form-control" placeholder="Enter Username">
</div>

<label for="">Password</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text fa fa-key" id="basic-addon1"></span>
  </div>
   <input type="password" name="passWord" value="" class="form-control" placeholder="Enter Password">
</div>

<p>Forgot password?<a href="forgotPass.php">Reset Here</a></p> 

<button type="submit" name="signinBtn" class="btn btn-success fa fa-check">Sign In</button>
<p>Do not have an account? <a href="signup.php">Sign Up</a></p> 


</form>


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