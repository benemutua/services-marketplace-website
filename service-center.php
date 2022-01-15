<!--import the db part-->
<?php require_once("dboperations.php"); ?>


<!--import the header-->
<?php require_once("header.php"); ?>
<!--end importing header-->


<!------------------------------------------
# START MAIN CONTAINER
------------------------------------------->
<main id="main">





<!--=====================================================================================
 code the search/filter button separately and implement form action for that specific button
======================================================================================-->
<?php
function filterTable($query){
require('assets/db/config.php');
$filter_Result = mysqli_query($link,$query);
return $filter_Result;
}
                                               
//coding the search button
if(isset($_POST['filterGoogleService'])){
$valueToSearch= mysqli_real_escape_string($link,$_POST['professionField']);
$query = "SELECT * FROM professionalstable AS pt
LEFT JOIN users AS us ON pt.user=us.username 
WHERE pt.status='active' AND field LIKE '%$valueToSearch%'
OR pt.status='active' AND speciality LIKE '%$valueToSearch%'
OR pt.status='active' AND about LIKE '%$valueToSearch%'
OR pt.status='active' AND first_name LIKE '%$valueToSearch%' 
OR pt.status='active' AND other_names LIKE '%$valueToSearch%' 
ORDER BY pt.verification='verified' DESC ";

$result = filterTable($query); 
}

else{
 $query = "SELECT * FROM professionalstable AS pt
 LEFT JOIN users AS us ON pt.user=us.username 
 WHERE pt.status='active' ORDER BY pt.verification='verified' DESC ";
$result= filterTable($query);
}
?>



<div class="breadcrumbs px-2"><!--start the breadcrumbs div-->


<!-----------------------------------------------------------------
start main div enclosing the sorter------------------------------->
<div class="sorterMainDiv">

<!--------------------start sorter 1----------------------------------------------->
<div class="sorter">
<h5><i class="ri-map-pin-user-line"></i> Google Choose who is close</h5>

<form action="" method="post">
<div class="input-group"><!--start the double input group--------->

<div class="flexerDiv px-1"><!--------start the custom container for google close div---->
<div class="form-check form-switch"><!--from  bootstrap-->
  <input class="form-check-input" type="checkbox" name="googleClose" id="flexSwitchCheckDefault">
  <label class="form-check-label" for="flexSwitchCheckDefault">Near Me</label>
</div><!--end the bootstrap classes/divs-->
</div><!--end the container for the google close div--->

<input type="text" name="professionField" value="" class="form-control" placeholder="Search keyword, eg Mechanic">
<button type="submit" name="filterGoogleService" class="btn btn-success fa fa-search"></button>
</div><!--end the double input group--->
</form>

</div><!-----------end sorter 1------------------------------------------------------>


<!--------------------start sorter 2----------------------------------------------->
<div class="sorter">
<h5><i class="ri-sort-desc"></i> OR Filter based on specific location?</h5>

<form action="" method="post">
<div class="input-group"><!--start the double input group--------->
<input type="text" name="speciality" value="" class="form-control" placeholder="Search keyword, eg Mechanic">
 <input type="text" name="locationAddress" value="" class="form-control" placeholder="Location eg Nairobi" >
  <button type="submit" name="filterService" class="btn btn-success fa fa-search"></button>
</div><!--end the double input group--->
</form>

</div><!-----------end sorter 2------------------------------------------------------>


</div><!-----------------------------------------------------------
CLOSE THE MAIN DIV ENCLOSING THE SORTERS------------------------------->
</div><!----------------------------------------------------------------
CLOSE THE BREADCRUMBS DIV---------------------------------------------->









<!------------------------------------------------------------------
GOOGLE ADS WINDOW-------------------------------------------------->

<div class="homeGoogleAds mb-5 mt-3">
Advertisement
</div>
<!----------------------END GOOGLE ADS WINDOW----------------------->








<!--call the modal-->
<!--?php require("modal.php"); ?>-->





<!--the outer most div starts here-->
<div class="bodyContainer">

<?php if($result->num_rows>0): ?>
<?php while($row=mysqli_fetch_array($result)): ?>

<!--START THE PROFESSIONAL/SERVICE LISTING MAIN CONTAINER--->
<div class="profMainParentContainer">

<div class="profDivisionContainerOne"><!--the left main container for image and service provider-->

<?php 
$resultGetImage=mysqli_query($link, "SELECT * FROM images WHERE image_category='profile' AND unique_owner='".$row['user']."' ");
if(mysqli_num_rows($resultGetImage)>0): ?>
<?php while($rowImage=mysqli_fetch_assoc($resultGetImage)): ?>
<!--if an image is found, show it-->

<?php echo "<img src='uploads/profiles/".$rowImage['image_name']."' alt='logo'>";?>


<?php endwhile; ?><!--end looping through images if any found-->
<?php else: ?><!--if there is no image found show empty-->
<img src="" alt="logo">
<?php endif; ?>  <!--end checking for image existence-->





<div class="containerOneInfoDiv"><!--this will introduce the service provider info--->

<?php if($row['title']!=null): ?><!--if the title is predefined show data-->
  <span><?php echo $row['title']; ?></span> <br>
<?php else: ?>
<?php endif; ?><!--end title check-->

<?php if($row['verification']=='verified'): ?><!--if the account owner is verified-->
<span><?php echo $row['first_name']; ?> <?php echo $row['other_names']; ?><i class="fa fa-check-circle-o">verified</i> </span>
<?php else: ?>
<span><?php echo $row['first_name']; ?> <?php echo $row['other_names']; ?> </span>
<?php endif; ?><!--end verification check-->

<h6><i class="fa fa-map-marker">Address Location</i></h6>
<span>County here..|</span> <span>Location here.................</span>

<a href="" class="mb-1 fa fa-external-link"> Click here to view in maps</a>
<h6><i class="fa fa-link">External website/LinkedIn </i></h6>
<span><a href="<?php echo $row['external_link']; ?>" target="_blank"><?php echo $row['external_link']; ?></a></span>

</div><!--end the service provider intro infomation-->
</div><!--end the first container for service provider and image-->


<div class="profDivisionContainerTwo"><!--the right side container housing service information--->

<div class="containerTwoHeadDiv"><!--housing contacts and service info parts---->

<div class="containerTwoUpperDiv"><!--the service type and info-->
<p>Services offered</p>
<span class="ri-medal-line"><?php echo $row['field']; ?></span>
<h5><?php echo $row['speciality']; ?></h5>
</div><!--end service type and info-->

<div class="theContactInfo containerTwoUpperDiv"><!--contacts info-->
<p>Contacts</p>

<!------------------------display online or offline based on time now------------->
<?php if($row['accesibility']=='During Day Time' && date('H')>18 && date('H')<06)://declare the person offline ?>
<h1><i class="fa fa-circle" style="color:red;"></i> Now Offline</h1>

<?php elseif($row['accesibility']=='At Night' && date('H')>06 && date('H')<18)://declare the person offline ?>
  <h1><i class="fa fa-circle" style="color:red;"></i> Now Offline</h1>

<?php else: //if the time doesnt fall from the above stated, then they are online ?>
<h1><i class="fa fa-circle" style="color:#18d26e;"></i> Online</h1>
<?php endif; ?>
<!-------------end displaying online or offline based on time--------------------->

<br>


<span class="ri-phone-line"> CALL: <?php echo $row['mobile_number']; ?></span> <br>
<span class="ri-mail-send-line"> Email:<a href="mailto: <?php echo $row['email']; ?>"> <?php echo $row['email']; ?></a>  </span>
</div><!--end contacts info-->

<!--On phone size, the contact info wont show and hence the button below will be used to display them-->
<button type="button" class="mySpecialBtn badge bg-success fa fa-eye-slash">Show contacts information</button>
</div><!--end the upper housing for contacts and service info-->



<div class="containerTwoAboutDiv"><!---container housing about information--->
<p>Description/About</p>
<span><?php echo $row['about']; ?></span>

<a href=""><i class="fa fa-sign-out">View Detailed Info</i></a>
</div><!--end container housing about information--->

</div><!--end the second container for service information-->

</div><!--END THE PROFESSIONAL/SERVICE LISTING MAIN CONTAINER--->


<!--end the wile loop -->
<?php endwhile; ?>
<!--if no service to display-->
<?php else: ?>

  <p>Oops, seems like there are no matching records for the search</p>

<?php endif; ?>

<!------------------------------------------------------------------
GOOGLE ADS WINDOW-------------------------------------------------->

<div class="homeGoogleAds mb-5 mt-3">
Advertisement
</div>
<!----------------------END GOOGLE ADS WINDOW----------------------->


</div><!--end the outermost div-->


<!--import the chatbot-->
<?php require_once("chatbot.php"); ?>
<!--end inmpoting-->




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
  <script src="assets/js/messageScripts.js"></script>
</body>
</html>