<!--call the db ops to allow check for sessions-->
<?php require_once("dboperations.php"); 

//if you are not logged in you cant access
if($_SESSION['loggedin']==false){
  header("location: login.php");
  exit;
}
?>



<!--import the header-->
<?php require_once("header.php"); ?>
<!--end importing header-->


<!------------------------------------------
# START MAIN CONTAINER
------------------------------------------->
<main id="main">

<div class="breadcrumbs"></div>
<br>

<!--================================================================
# professional registration panel
=================================================================-->

<!--=================================================================
    SUCCESS AND ERROR MESSAGES
=================================================================-->
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
    <!--------------end the session messages part------->


<!--------------------------------------------------------
this div show custom message----------------------------->
<div class="customMessage">
<p class="mb-1 customlabel">Are you a cooperate offering Services on different Fields? Reach out to our support on email 
  <a href="mailto: support@serviceskenya.co.ke">support@serviceskenya.co.ke</a> OR call direct
  on <a href="tel: 0708672495"> 0708 672 495</a>.</p>
</div>
<!-----------------------end the custom message div----->

    
<form action="dboperations.php" method="post" enctype="multipart/form-data"><!----form starts here-->
<div class="registrationcard"><!---------------start parent container------------------>
<div class="registrationcardBlock"><!--start first block---->




<label for="">Title(optional)<label class="customlabel">Skip if a Cooperate</label></label>
<input type="text" name="initials" value="" class="form-control" placeholder="PHD/DR/MBA/Mr/Mrs/Miss...">


<label for="">First name</label>
<input type="text" name="fname" value="" class="form-control" placeholder="John">


<label for="">Other name</label>
<input type="text" name="sname" value="" class="form-control"  placeholder="Doe">

<label for="">Mobile Number</label>
<input type="number" name="mobile" value="" class="form-control" placeholder="eg 07xx" maxlength="10">


<label class="customlabel" for="checkbox1">
<input type="radio" name="publicAccess" value="Public" checked="checked" id="checkbox1">
My number can be made available for clients to reach out
</label>


<label class="customlabel" for="checkbox2">
<input type="radio" name="publicAccess" value="Not public" id="checkbox2">
I don't want my phone Number to be publicly available
</label><br>




<label for="">Email address</label>
<input type="email" name="email" value="<?php echo  $_SESSION['email']; ?>" class="form-control inactive" placeholder="123@example.com">



<label for="">Field & Specialization</label>
<div class="input-group">
<?php require("fieldlist.php"); ?><!--call the field list file-->
<input type="text" name="specialityField" value="" placeholder="Specialization area eg audit, tax"  class="form-control">
</div>
<label class="customlabel fa fa-arrow-up" for="">
Separate with '|' if many LIKE:  Audit|Tax|Book Keeping
</label>


  <label for="">Professional Body(optional)</label>
  <input type="text" name="associations" value="" class="form-control" placeholder="eg LSK">




<label for="">Where can we find you?</label>

<select id="localeOptionChooser" class="form-control">
<option value="">-select location-</option>
<option value="my current location"> Pin my current location</option>
<option value="type business location">Type a different address</option>
</select>

<input type="text" name="myLocationName" id="myPinLocation" placeholder="Type the location" maxlength="60" class="form-control mt-2 hidden">
<input type="text" name="myLocationName" id="googleSuggestLocation" placeholder="Type and google will suggest" class="form-control mt-2 hidden">


<div class="input-group mt-2">
  <input type="text" name="latitude" id="latInfo" class="form-control">
  <input type="text" name="longitude" id="longInfo" class="form-control">
</div>
<!---the maps script will be imported at the end as localeJavascript----->

</div><!-----------------------end the first block----------->



<div class="registrationcardBlock"><!---------------start second block--->

<label for="">Website/LinkedIn profile(optional)</label>
<input type="text" name="myUrl" value="" class="form-control" placeholder="Must ONLY start with www. eg www.mysite.com">


<div class="mb-1">
<label for="" class="form-label">Describe What you do:</label>
<textarea name="about" value="" placeholder="Describe your profession" maxlength="500" class="form-control"  rows="3"></textarea>
</div>


<label for="">Are you Mobile?</label>
<select name="mobility" class="form-control">
<option value="">-select-</option>
<option value="Mobile to work">Yes</option>
<option value="Not Mobile">No</option>
</select>


<label for="">My contact hours?</label>
<select name="accesibility" class="form-control">
<option value="">-select-</option>
<option value="During Day Time">Daytime</option>
<option value="At Night">Night</option>
<option value="24/7">24/7</option>
</select>



<div class="paymentsDiv"><!---------------start the payments DIV--------->
 <h5>Billing Info</h5> 

<label for="">Choose subscription plan</label>
<div class="input-group mb-1">
<select name="subscription" id="paymentOption" class="form-control">
<option value="">-choose-</option>
<option value="2 months">2 Months</option>
<option value="4 months">4 Months</option>
<option value="6 months">6 Months</option>
<option value="12 months">12 Months</option>
</select>
<input type="text" name="payableAmount" id="payableAmount" value="" placeholder="KES:0000" class="form-control inactive">
</div>

<label for="" class="customlabel">Pay using this Phone no:</label><br>
<input type="number" class="form-control" name="myPaymentNumber" placeholder="07xx" maxlength="10">


<h6>MPESA TILL NUMBER: 355355</h6>
<!--show STK PUSH based on whichever you choose-->
<label> <input type="radio" name="push_option" value="" checked="checked">Pay Instantly</label>
<label> <input type="radio" name="push_option" value=""  >Pay Later </label>
<!--end the STK push option-->

<p style="font-weight:200; font-size:12px; background:white;"><!--start explaining payments-->
PAY INSTANTLY: STK PUSH to pay. A/c will become ACTIVE immediately <br>
PAY LATER: Pay later to Mpesa. A/c will be INACTIVE untill you pay
</p><!--end explaining-->
</div><!-------finish the payments div--->

<button type="submit" name="submitRegistration" id="submitProfile"  class="btn btn-success" disabled> <i class="fa fa-plus"></i> Submit Records</button>
</div><!------end the second block container---->

</div><!------------------end the parent container--------------->
</form><!----form close-->


<script>
//for the payment options
var paymentOptionChosen=document.getElementById("paymentOption");
var payAmount=document.getElementById("payableAmount");
var saveProfile=document.getElementById("submitProfile");

$(paymentOptionChosen).on("change", function(){
if(paymentOptionChosen.value=="2 months"){
payAmount.value=2000;
saveProfile.disabled=false;
}

else if(paymentOptionChosen.value=="4 months"){
payAmount.value=3500;
saveProfile.disabled=false;
}

else if(paymentOptionChosen.value=="6 months"){
payAmount.value=5000;
saveProfile.disabled=false;
}

else if(paymentOptionChosen.value=="12 months"){
payAmount.value=9000;
saveProfile.disabled=false;
}
else{
payAmount.value="";
saveProfile.disabled=true;
}

});
</script>





</main><!-- End #main -->

<!------------------------------------------
# END MAIN CONTAINER
------------------------------------------->





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
  <script src="assets/js/localeJavascript.js"></script><!--maps-->
</body>

</html>