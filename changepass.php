<!--call the db ops to allow check for sessions-->
<?php require_once("dboperations.php"); 

//if you are not logged in you cant access
if($_SESSION['loggedin']==false){
  header("location: login.php");
  exit;
}
?>




<!--import the header section-->
<?php require_once("header.php"); ?>
<!--end importing header-->


<div class="breadcrumbs"></div>







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





<form action="dboperations.php" method="post"><!--start the input form-->
<label for="">Old Password</label>
<div class="input-group mb-3">
   <input type="password" name="oldPass" value="" class="form-control" placeholder="Old pass">
</div>

<label for="">New Password</label>
<div class="input-group mb-3">
   <input type="password" name="newPass" value="" class="form-control" placeholder="enter new pass">
</div>


<label for="">Confirm Password</label>
<div class="input-group mb-3">
   <input type="password" name="confNewPass" value="" class="form-control" placeholder="confirm Password">
</div>

<button type="submit" name="changeMyPassword" class="btn btn-success">Change pass</button>

</form><!--end the input form-->


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