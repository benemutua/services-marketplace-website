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








<!--================================================================
# USER SELF MANAGEMENT WIZARD MAIN DIV
=================================================================-->
<div class="registrationcardBlock" style="margin:auto;">

<!--=======================================================
    SUCCESS AND ERROR MESSAGES
=========================================================-->
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


















<!----------------------------------------------
THIS CODE RUNS ALL TIMES
---------------------------------------------->
<?php
$sqlUserInfo="SELECT * from users AS us
LEFT JOIN professionalstable AS ps
ON us.username=ps.user

WHERE us.username='".$_SESSION['user']."' ";

$rstUserInfo=mysqli_query($link, $sqlUserInfo);
while($rowUserInfo=mysqli_fetch_assoc($rstUserInfo)): ?>


<!----------------------------------------------------------
the loops shows in the text fields and data below
------------------------------------------------------------>


<!---------------------------------------------------------------------
START THE ACCOUNT ACTIONS DIV
---------------------------------------------------------------------->
<div class="myprofilediv">
<h5>Actions</h5>
<hr>

<a href="registrations.php">
<span class="badge bg-secondary fa fa-upload p-2 mb-2">Post Service</span>
</a>


<a href="#">
<span class="badge bg-warning fa fa-edit p-2 mb-2" id="btnEditAccount"> Edit </span>
</a>

<a href="benesoftke.co.ke/myid" target="_blank">
<span class="badge bg-info fa fa-link p-2 mb-2"> My Services</span>
</a>

<a href="dboperations.php?getMyStatements=<?php echo $_SESSION['user']; ?>" target="_blank" download>
<span class="badge bg-success fa fa-file-pdf-o p-2 mb-2"> Payment statements</span>
</a>

<a href="#" id="deleteAccount">
<span class="badge bg-danger fa fa-trash p-2 mb-2"> Delete A/c</span>
</a>





<!-----------------------------------------------------------------------------
THIS PART BWILL SHOW WHEN ONE HAS ONLY DELETED ACCOUNT. ELSE IT WILL BE BLANK
------------------------------------------------------------------------------>
<?php if($rowUserInfo['status']=='scheduled delete'): ?>

<br>
<span class="mt-3">Scheduled Delete on: <?php echo $rowUserInfo['delete_on']; ?></span>
<form action="dboperations.php" method="post"><!--start the undodelete form-->
<button type="submit" name="revertDelete"  class="btn badge bg-secondary fa fa-undo"> Restore?</button>
</form><!--end the undo delete form-->


<?php else: ?>
<?php endif; ?>
<!------------------------------------------------------------------------------
END THAT SPECIAL SHOWING SECTION
------------------------------------------------------------------------------->





<!---------------------------------------------
THE DELETE ACcount DIV------------------------>
<div class="hiddenDeleteDiv mb-2 mt-3 hidden">

<div class="customMessage"><!--start explanatory message-->
<p class="mb-1 customlabel">
The account will remain on the system for 60 days. To recover, You can recover the account before the time elapses
</p>
</div><!--end the message-->


<form action="dboperations.php" method="post"><!---start the delete form--->
<label>Type " <i>delete-me</i> " in the box below to delete your account</label>
<div class="input-group mb-1">
<input type="text" value="" id="deleteMyData" class="form-control" placeholder="delete-me">
</div>
<button type="submit" name="deleteMe"  id="finalyDelete" class="btn btn-danger fa fa-trash" disabled> Delete A/c</button>

<a href="#" id="closeWindow">Close window</a>
</form><!---end the form-->
</div>
<!--------END THE DELETE ACTION DIV---->


</div>
<!----------------------------------------------------------------
END THE ACTIONS DIV---------------------------------------------->







<!--------------------------------------------------------
my account payment records
--------------------------------------------------------->
<?php 
$getPaymentInfo=mysqli_query($link, "SELECT * FROM paymentstable WHERE payment_status='active' AND user='".$_SESSION['user']."' ");
if(mysqli_num_rows($getPaymentInfo)>0): ?>
<?php while($rowGetPayment=mysqli_fetch_assoc($getPaymentInfo)): ?>



<div class="myPaymentRecordsDiv">

<div class="smallPaymentDivs"><!--the details div-->
<p class="mb-1">PAY STATUS</p>
<span><?php echo $rowGetPayment['payment_status']; ?></span>
</div><!--end-->

<div class="smallPaymentDivs"><!--the details div-->
<P class="mb-1">PAY CODE</P>
<span><?php echo $rowGetPayment['payment_message']; ?></span>
</div><!--end-->

<div class="smallPaymentDivs"><!--the details div-->
<P class="mb-1">PAID ON</P>
<span><?php echo $rowGetPayment['add_date']; ?></span>
</div><!--end-->

<div class="smallPaymentDivs"><!--the details div-->
<P class="mb-1">EXP DATE</P>
<span><?php echo $rowGetPayment['expires_on']; ?></span>
</div><!--end-->

</div>
<!--------------------------------------------------------
end my account payment records
--------------------------------------------------------->

<?php endwhile; ?><!--end the while loop-->
<?php else: ?><!---if no payment is active, echo out-->

<div class="myprofilediv">
<h6><i class="ri-information-line"></i> Active payments will show here.</h6>
<h6><i class="ri-information-line"></i> Either you have not paid or your payment expired.</h6>
<span><i class="ri-question-line"></i>    Something else? <a href="contact.php">Contact support Here</a> </span><br>

<a href="dboperations.php?getMyStatements=<?php echo $_SESSION['user']; ?>" target="_blank" download>
<span class="badge bg-primary fa fa-file-excel-o p-2"> Get statements</span>
</a>

<a href="#" id="myPaymentsBtn">
<span class="badge bg-success fa fa-usd p-2"> Make Payment</span>
</a>

</div>

<?php endif; ?>












<!--------------------------------------------------------------------
START THE PERSONAL INFOR DIV
--------------------------------------------------------------------->
<div class="myprofilediv">

<!----------------------------------------------------------
REQUIRE THE MODAL for editing user info-------------------->
<?php require("modal.php"); ?>





<!----------------------get the persons image if any-------->
<?php 
$resultGetImage=mysqli_query($link, "SELECT * FROM images WHERE image_category='profile' AND unique_owner='".$_SESSION['user']."' ");
if(mysqli_num_rows($resultGetImage)>0): ?>
<?php while($rowImage=mysqli_fetch_assoc($resultGetImage)): ?>
<!--if an image is found, show it-->

<div class="myLogoDiv"><!--start the image logo div-->
<?php echo "<img src='uploads/profiles/".$rowImage['image_name']."' alt='logo'>";?>
</div><!--end the image logo div-->
<?php endwhile; ?><!--end looping through images if any found-->


<?php else: ?>
<div class="myLogoDiv"><!-- start image logo outer div-->
<!--if no image found, tell the user to add it-->
<div class="customMessage"><!--start explanatory message-->
<p class="mb-1 customlabel">service ads with a profile image stand a higher chance in influencing visitors</p>
</div><!--end the message-->

<h6>Click below to add a profile image for identity</h6>
<form action="dboperations.php" method="post" enctype='multipart/form-data'><!--start fom for insert image-->
<label for="myProfileImg" ><img id="profileImage" /></label>
<input type="file" name="image" id="myProfileImg" required onchange="previewImage(event);">
<button type="submit" name="insertImage" class="fa fa-plus btn btn-success">Save</button>
</form><!--end insert image form-->
</div><!--end the image logo outer div-->
<?php endif; ?>

<!--------------------------------end the persons profile image---------------->






<!-----the text user information-->
<label for="">User</label>
<div class="input-group mb-1">
  <input type="text" name="username" value="<?php echo $_SESSION['user']; ?>" class="form-control" placeholder="my username">
</div>

<label for="">Contacts</label>
<div class="input-group mb-1">
   <input type="text" name="emailAddress" value="<?php echo $_SESSION['email']; ?>" class="form-control" placeholder="email">
  <input type="text" name="mobileNumber" value="<?php echo $rowUserInfo['mobile_number']; ?>" class="form-control" placeholder="Phone number">
</div>

<label for="">Full names</label>
<div class="input-group mb-1">
  <input type="text" name="username" value="<?php echo $rowUserInfo['first_name']; ?> <?php echo $rowUserInfo['other_names']; ?>" class="form-control" placeholder="First and second names">
</div>

<label for="">Website/LinkedIn</label>
<div class="input-group mb-1">
  <input type="text" name="username" value="<?php echo $rowUserInfo['external_link']; ?>" class="form-control" placeholder="my website or LinkedIn profile">
</div>




</div>
<!-----------------------------------------------------------
END THE PERSONAL INFO DIV----------------------------------->


<?php endwhile; ?>


</div><!----------------------------------------------------
END THE MAIN PARENT DIV------------------------------------->


</main>
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
  <script src="assets/js/mycustomjsfile.js"></script>
</body>

</html>