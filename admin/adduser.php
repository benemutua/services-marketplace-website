<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
<hr>  




<div class="logContainer"><!--end the login container-->

<h5> <i class="fa fa-lock"></i> CREATE NEW USER</h5>


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
    <?php endif ?>
    <!-----------end the success and error messages-------->


<form action="dboperations.php" method="post"><!--start registration form the form-->
<label for="">Username</label>
<input type="text" name="userName" value="" placeholder="Enter username" class="form-control" >

<label for="">Email</label>
<input type="email" name="emailAddress" value="" placeholder="Enter user email" class="form-control" >

<label for="">Password</label>
<input type="password" name="passWord" value="" placeholder="Enter user Password" class="form-control mb-3" >

<label for="">Confirm Password</label>
<input type="password" name="confPassWord" value="" placeholder="Confirm password" class="form-control mb-3" >


<button type="submit" name="addUser" class="btn btn-success fa fa-plus">Add account</button>

</form><!--close the form-->
</div><!--end the login container-->





</section><!-- close wrapper wrapper section-->
</section><!-- close main content section -->

          
  
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
