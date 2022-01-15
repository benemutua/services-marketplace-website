


<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
<hr>  

<?php
$myinfo=mysqli_query($link, "SELECT * FROM users AS us
LEFT JOIN professionalstable AS pt
 ON us.username=pt.user
WHERE us.username='".$_SESSION['user']."'  ");

while($rowMyInfo=mysqli_fetch_assoc($myinfo)): ?>





<!--start the my info div panel-->
<div class="professionalInnerDiv">

<img src="img/favicon.png" style="width:100px; height:100px; border:1px solid gainsboro; border-radius:50%;">
<br>

<label for="">Username</label>
<input type="text"  value="<?php echo $_SESSION['user']; ?>" placeholder="login name" class="form-control mb-2" >


<label for="">Full Name</label>
<input type="text" value="<?php echo $rowMyInfo['first_name']; ?>  <?php echo $rowMyInfo['other_names']; ?>" placeholder="eg john" class="form-control mb-2" >

<label for="">Mobile Number</label>
<input type="text"  value="<?php echo $rowMyInfo['mobile_number']; ?>" placeholder="07xxx" class="form-control mb-2" >

<label for="">Email</label>
<input type="text"  value="<?php echo $rowMyInfo['email']; ?>" placeholder="email address" class="form-control mb-2" >


</div>
<!--end the my info div Div-->

<?php endwhile; ?>



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
  <script src="js/mycustomjsfile.js"></script>