<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
<hr>  


<!--php file to get user/professional details-->
<?php
if(isset($_GET['viewProfessional'])){
$getUserId=$_GET['viewProfessional'];

$getProfessionalDetails=mysqli_query($link, "
SELECT * FROM professionalstable AS pt 
LEFT JOIN users AS us ON pt.user=us.username

WHERE us.user_id=$getUserId ");
if(mysqli_num_rows($getProfessionalDetails)>0): ?>
<?php while($rowGetData=mysqli_fetch_assoc($getProfessionalDetails)):
    $mobility=$rowGetData['mobility'];
    $accesibility=$rowGetData['accesibility'];
    $fieldGlobal=$rowGetData['field'];
    $verification=$rowGetData['verification'];
    $userGlobal=$rowGetData['username'];
    ?>
<!--start the while loop execution-->



<!--display the tab container------------->
<div class="warningBox mb-3">
<i class="fa fa-info"></i> USER INFOR / CONNECTED PAYMENTS DATA</div>
<!--end the notification container-->



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





<!--start the professional registration panel-->
<form action="dboperations.php" method="post"><!-----start the update form-->
<div class="professionalParentDiv">
<div class="professionalInnerDiv"><!--start the first block of registration-->

<input type="text" name="userName" value="<?php echo $rowGetData['user']; ?>" class="hidden"><!--the a/c user-->

<label for="">Title</label>
<input type="text" name="initials" value="<?php echo $rowGetData['title']; ?>" placeholder="eg PHD/ MBA/ Mr/Mrs/Eng" class="form-control mb-2" >

<label for="">First Name/ Second Name</label>
<div class="input-group">
<input type="text" name="firstName" value="<?php echo $rowGetData['first_name']; ?>" placeholder="eg john" class="form-control mb-2" >
<input type="text" name="otherNames" value="<?php echo $rowGetData['other_names']; ?>" placeholder="eg Doe" class="form-control mb-2" >
</div>



<label for="">Mobile/ Email Address</label>
<div class="input-group">
<input type="text" name="mobileNumber" value="<?php echo $rowGetData['mobile_number']; ?>" placeholder="07xxx" class="form-control mb-2" >
<input type="email" name="email" value="<?php echo $rowGetData['email']; ?>" placeholder="123@example.com" class="form-control mb-2" >
</div>

<label for="">Field/Profession</label>
<?php require_once("fieldlist.php"); ?><!---import the field data-->


<label for="">Specialization</label>
<div class="input-group">
    <input type="text" name="speciality" value="<?php echo $rowGetData['speciality']; ?>" class="form-control"  placeholder="Specialization eg Audit, Tax, book keeping"> 
    </div>
 
    <label for="">Professional Body(optional)</label>
<input type="text" name="associations" value="<?php echo $rowGetData['associations']; ?>" placeholder="eg LSK, EBK" class="form-control mb-2" >

<label for="">Account Status/ Verification</label><!--the holder account status-->
<div class="input-group">
<select name="userStatus" class="form-control">
<option value="">-select-</option>
<option value="active" <?php if($rowGetData['status']=="active") echo 'selected="selected"'; ?>>Active</option>
<option value="inactive" <?php if($rowGetData['status']=="inactive") echo 'selected="selected"'; ?>>Inactive</option>
<option value="scheduled delete" <?php if($rowGetData['status']=="scheduled delete") echo 'selected="selected"'; ?>>Scheduled Delete</option>
</select>


<select name="verification" class="form-control"><!--the holder account verification status-->
<option value="">-select-</option>
<option value="unverified" <?php if($verification=="unverified") echo 'selected="selected"'; ?>>Unverified A/c</option>
<option value="verified" <?php if($verification=="verified") echo 'selected="selected"'; ?>>Verified A/c</option>
</select>
</div>


</div><!--end the first block of registration-->





<div class="professionalInnerDiv"><!--start the second block of registration-->
<label for="">Website/LinkedIn profile(optional)</label>
<input type="text" name="myUrl" value="<?php echo $rowGetData['external_link']; ?>" placeholder="eg www.mywebsite.com" class="form-control mb-2" >



<label for="">Are you Mobile?</label>
<div class="input-group mb-1">
<select name="mobility" class="form-control">
<option value="">-select-</option>
<option value="Mobile to work" <?php if($mobility=="Mobile to work") echo 'selected="selected"'; ?>>Yes</option>
<option value="Not Mobile" <?php if($mobility=="Not Mobile") echo 'selected="selected"'; ?>>No</option>
</select>
</div>


<label for="">When Do you Operate?</label>
<div class="input-group mb-1">
<select name="accesibility" class="form-control">
<option value="">-select-</option>
<option value="During Day Time" <?php if($accesibility=="During Day Time") echo 'selected="selected"'; ?>>Daytime</option>
<option value="At Night" <?php if($accesibility=="At Night") echo 'selected="selected"'; ?>>Night</option>
<option value="24/7"  <?php if($accesibility=="24/7") echo 'selected="selected"'; ?>>24/7</option>
</select>
</div>

<label for="" class="form-label">Describe What you do:</label>
<div class="mb-1">
  <textarea name="about" value="" placeholder="Describe your profession" maxlength="500" class="form-control"  rows="2">
  <?php echo $rowGetData['about']; ?>
  </textarea>
</div>


<!--display the tab container------------->
<div class="warningBox mt-3">
    For security reasons, edit has been disabled . kindly fill the below form appropriately to enable editing
</div>
<!--end the notification container-->


<label for="">Type " <i>edit-data</i> " to enable editing</label>

<input type="text"  value="" id="enableeditInfo" placeholder="edit-data" class="form-control mb-2" >



<button type="submit" name="submitUpdateData" class="btn btn-success fa fa-check" id="updateDataRecords" disabled>update Records</button>
</div><!--end the second block of registration-->

</div>
</form><!--finish the update form-->
<!--end the professional registration Div-->
<?php endwhile; ?>
<?php else: ?>
    <p>Something went wrong</p>
 <?php endif; ?>   
<?php } ?>



<!--- THE PAYM,ENT HISTORY TABLE STARTS HERE-->

<div class="tablesSliderDiv"><!----start the table enclosure div-->
<table class="table table-striped table-bordered">
<tr>
<th>Pay No.</th>
<th>Payment Terms</th>
<th>Amount</th>
<th>Status</th>
<th>Paid On</th>
<th>Expiry</th>
</tr>
<?php
$rstPayments=mysqli_query($link, "SELECT * FROM paymentstable WHERE user='$userGlobal' ");
if(mysqli_num_rows($rstPayments)>0):?>
<?php while($rowPayments=mysqli_fetch_assoc($rstPayments)): ?>
<tr>
<td><?php echo $rowPayments['payment_id']; ?></td>
<td><?php echo $rowPayments['subscription_terms']; ?></td>
<td><?php echo $rowPayments['paid_amount']; ?></td>
<td><?php echo $rowPayments['payment_status']; ?></td>
<td><?php echo date("H:i d/m/Y", strtotime($rowPayments['expires_on'])); ?></td>
<td><?php echo date("Y/m/d", strtotime($rowPayments['expires_on'])); ?></td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
<td colspan="10"> <p>No payment history recorded</p> </td>
</tr>
<?php endif; ?>


</table>
</div><!----end the table enclosure div-->
<!----END THE TABLE PAYMENT HISTORY-->







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