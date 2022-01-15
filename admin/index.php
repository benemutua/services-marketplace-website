
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


<!----start the card containers parent window----->
<div class="indexParentDiv">

<a href="account-manager.php"><!--make the card a link-->
<div class="indexCardContainers"><!--start card 1-->
<?php 
$seeServices=mysqli_query($link, "SELECT * FROM professionalstable WHERE status='active' ");
echo "<p>";
echo mysqli_num_rows($seeServices);
echo "</p>";
?>
<span class="fa fa-user"> Service Providers</span>
</div><!--end card 1-->
</a><!--end referal link-->


<a href="payment-manager.php"><!--make the card a link-->
<div class="indexCardContainers"><!--start card 2-->
<?php 

$result=mysqli_query($link,"SELECT payment_message, SUM(paid_amount) AS paid_amount_sum FROM paymentstable
WHERE payment_message='success'  AND MONTH(add_date) = MONTH(CURRENT_DATE())
AND YEAR(add_date) = YEAR(CURRENT_DATE())");

$row = mysqli_fetch_assoc($result); 
$sum = $row['paid_amount_sum'];
echo "<p>KES: $sum </p>";
?>
<span class="fa fa-usd"> Paid This Month</span>
</div><!--end card 2-->
</a><!--end referal link-->


<a href="messages-unread.php"><!--make the card a link-->
<div class="indexCardContainers"><!--start card 3-->
<?php 
$unreadMess=mysqli_query($link, "SELECT * FROM chatbot WHERE status='delivered' ");
echo "<p>";
echo mysqli_num_rows($unreadMess);
echo "</p>";
?>
<span class="fa fa-comments"> Unread Messages</span>
</div><!--end card 3-->
</a><!--end referal link-->




<a href="account-verification.php"><!--make the card a link-->
<div class="indexCardContainers"><!--start card 1-->
<?php 
$verified=mysqli_query($link, "SELECT * FROM professionalstable WHERE status='active' AND verification='verified' ");
echo "<p>";
echo mysqli_num_rows($verified);
echo "</p>";
?>
<span class="fa fa-user-circle-o"> Verified Services</span>
</div><!--end card 1-->
</a><!--end referal link-->

</div>
<!--end the card containers parent window-->




<!--startThe search field div-->
<div class="searchFieldDiv mt-5">

 
<!--=====================================================================================
 code the search/filter button separately and implement form action for that specific button
======================================================================================-->
<?php
function filterTable($query){
require("db/config.php");
$filter_Result = mysqli_query($link,$query);
    return $filter_Result;
}
                                               
//coding the search button
if(isset($_POST['searchUser'])){
$searchValue= mysqli_real_escape_string($link,$_POST['valueToSearch']);
$query = "SELECT * FROM professionalstable AS pt
RIGHT JOIN users  AS us ON pt.user=us.username
RIGHT JOIN paymentstable AS pyt ON  pt.user=pyt.user

WHERE 
first_name LIKE '%$searchValue%' 
OR other_names LIKE '%$searchValue%' 
OR field LIKE '%$searchValue%'
OR speciality LIKE '%$searchValue%'
OR verification LIKE '%$searchValue%'
OR payment_status LIKE '%$searchValue%'

ORDER BY payment_id DESC";

$result = filterTable($query);  
}
else{
 $query = "SELECT * FROM professionalstable AS pt
 RIGHT JOIN users  AS us ON pt.user=us.username
 RIGHT JOIN paymentstable AS pyt ON  pt.user=pyt.user
 ORDER BY payment_id DESC";
$result= filterTable($query);
}                                      
?><!--end the search query-->

        
   
<form action="" method="post">
<div class="input-group">
    <input type="text" name="valueToSearch" value="" class="form-control"  placeholder="Type the keyword to search">
    <button type="submit" name="searchUser" class="btn btn-primary fa fa-search">Search</button>  
    </div>
</div>
<!--end search field div-->







  
<!---start the tables slider div makes the tables responsive-->
<div class="tablesSliderDiv mt-10">
<!--start of the table -->
<table class="table table-striped">
  <thead>
    <tr>
      <th>PayNo.</th>
      <th>Pay Date</th>
      <th>First name</th>
      <th>Second Name</th>
      <th>field</th>
      <th>Phone</th>
      <th>UserNo.</th>
      <th>Actions</th>
    </tr>
  </thead>
  <?php if($result->num_rows>0): ?>      
  <?php while($row = mysqli_fetch_array($result)): ?>
<!--if there are users, display them-->
  
    <tr>
    <td><?php echo $row['payment_id']; ?></td>
    <td><?php echo date("H:m d/m/Y" ,strtotime($row['add_date'])); ?></td>
      <td><?php echo $row['first_name']; ?></td>
      <td><?php echo $row['other_names']; ?></td>
      <td><?php echo $row['field']; ?></td>
      <td><?php echo $row['mobile_number']; ?></td>
     <td>
        <span class="badge bg-info"><?php echo $row['user_id']; ?></span>
      </td> 

      <td><!--start the view button-->
      <a href="view-professional.php?viewProfessional=<?php echo $row['user_id']; ?>" class="badge bg-primary"> <i class="fa fa-eye">View</i> </a>
      </td>
   

</tr>

<?php endwhile; ?>
<!--if no user found, show -->
<?php else: ?>
<tr><td colspan="10"><i class="fa fa-remove">No matches Found</i></td></tr>
<?php endif; ?>
<!--end checking for users-->

</table>


</div>
<!--end the responsive slider div for tables-->
</form><!--close the search form-->







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
