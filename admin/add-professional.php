<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
<hr>  





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

<form action="dboperations.php" method="post" enctype="multipart/form-data"><!--start the entry/prof reg form-->
<div class="professionalParentDiv">

<div class="professionalInnerDiv"><!--start the first block of registration-->

<label for="">Title</label>
<input type="text" name="initials" value="" placeholder="eg PHD/ MBA/ Mr/Mrs/Eng" class="form-control mb-2" >

<label for="">First Name</label>
<input type="text" name="firstName" value="" placeholder="eg john" class="form-control mb-2" >

<label for="">Other Names</label>
<input type="text" name="otherNames" value="" placeholder="eg Doe" class="form-control mb-2" >

<label for="">Mobile Number</label>
<input type="text" name="mobileNumber" value="" placeholder="07xxx" class="form-control mb-2" >

<label for="radio1" class="customLabel">
 <input type="radio" name="mobile_public"  value="Public" id="radio1" checked="checked"> 
 My number can be made available for clients to reach out  
</label>

<label for="radio2" class="customLabel mb-2">
 <input type="radio" name="mobile_public"  value="Not public" id="radio2"> 
 I don't want my phone Number to be publicly available 
</label><br>


<label for="">Email</label>
<input type="email" name="email" value="" placeholder="123@example.com" class="form-control mb-2" >

<label for="">Field & Specialization</label>
<div class="input-group">
    <?php require_once("fieldlist.php"); ?>
    <input type="text" name="speciality" value="" class="form-control"  placeholder="Specialization eg Audit, Tax, book keeping"> 
    </div>
    <label for="" class="customLabel fa fa-arrow-up">
    Separate with '|' if many LIKE: Audit|Tax|Book Keeping
    </label>


    <label for="">Professional Body(optional)</label>
<input type="text" name="associations" value="" placeholder="eg LSK, EBK" class="form-control mb-2" >

<label for="">Website/LinkedIn profile(optional)</label>
<input type="text" name="myUrl" value="" placeholder="eg www.mywebsite.com" class="form-control mb-2" >

<label for="">Are you Mobile?</label>
<div class="input-group mb-1">
<select name="mobility" class="form-control">
<option value="">-select-</option>
<option value="Mobile to work">Yes</option>
<option value="Not Mobile">No</option>
</select>
</div>

</div><!--end the first block of registration-->





<div class="professionalInnerDiv"><!--start the second block of registration-->

<label for="">When Do you Operate?</label>
<div class="input-group mb-1">
<select name="accesibility" class="form-control">
<option value="">-select-</option>
<option value="During Day Time">Daytime</option>
<option value="At Night">Night</option>
<option value="24/7">24/7</option>
</select>
</div>

<label for="" class="form-label">Describe What you do:</label>
<div class="mb-1">
  <textarea name="about" value="" placeholder="Describe your profession" maxlength="500" class="form-control"  rows="3"></textarea>
</div>


<!-------------------------------------------------------------------
---start the Hidden  payments DIV----------------------------------->
<div class="paymentsDiv">
<h5>Subscription Wizard</h5> 
<label for="">Subscribe for what duration?</label>
<div class="input-group mb-1">
<select name="subscription" id="subscriptionGateway" class="form-control">
<option value="">-select option-</option>
<option value="2 months">2 Months</option>
<option value="4 months">4 Months</option>
<option value="6 months">6 Months</option>
<option value="12 months">12 Months</option>
</select>
</div>

<label for="" class="customlabel">For Account:</label><br>
<input type="text" name="userName" value="" placeholder="Enter the username to create a/c for" class="form-control">

<label for="" class="customlabel">Payable Amount[KES]:</label><br>
<input type="text" name="payAmount" value="" id="payableAmount" placeholder="This field is automatic based on selection above" class="form-control inactive customInput">

<label for="" class="customlabel">Pay using this Phone no:</label><br>
<input type="text" name="myPaymentNumber" value="" maxlength="10" placeholder="enter the phone number to pay from. 07xx" class="form-control">

<h6>MPESA TILL NUMBER: 355355</h6>
<!--show STK PUSH based on whichever you choose-->
<label> <input type="radio" name="push_option" value="" checked="checked">Pay Instantly</label>
<label> <input type="radio" name="push_option" value=""  >Pay Later </label>
<!--end the STK push option-->

<p class="customLabel"><!--start explaining payments-->
PAY INSTANTLY: STK PUSH to pay. A/c will become ACTIVE immediately <br>
PAY LATER: Pay later to Mpesa. A/c will be INACTIVE untill you pay
</p><!--end explaining-->

</div>
<!-------END OF THE HIDDEN PAYMENT DIV-------------------------------
-------------------------------------------------------------------->

<button type="submit" name="submitRegistration" id="myPaymentSubscription" class="btn btn-success" disabled>Add Professional</button>

</div><!--end the second block of registration-->

</div>
</form><!----close the prof reg form-->
<!--end the professional registration Div-->





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