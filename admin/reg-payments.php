<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
<hr>  


<!----start the card containers parent window----->
<div class="indexParentDiv">

<div class="indexCardContainers"><!--start card 1-->
<?php 

$result=mysqli_query($link,"SELECT payment_message,account, SUM(paid_amount) AS paid_amount_sum FROM paymentstable
WHERE payment_message='success' AND account='registrations' AND MONTH(add_date) = MONTH(CURRENT_DATE())
AND YEAR(add_date) = YEAR(CURRENT_DATE())");

$row = mysqli_fetch_assoc($result); 
$sum = $row['paid_amount_sum'];
echo "<p>KES: $sum </p>";
?>
<span class="fa fa-usd"> Paid This Month</span>
</div><!--end card 1-->


</div>
<!--end the card containers parent window-->










<!--startThe search field div-->
<div class="searchFieldDiv">

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
RIGHT JOIN users AS us ON pt.user=us.username
RIGHT JOIN paymentstable AS pyt ON pt.user=pyt.user

WHERE 
username LIKE '%$searchValue%' AND account='registrations'
OR email LIKE '%$searchValue%' AND account='registrations'
OR first_name LIKE '%$searchValue%' AND account='registrations'
OR other_names LIKE '%$searchValue%' AND account='registrations'
OR mobile_number LIKE '%$searchValue%' AND account='registrations'
ORDER BY pyt.payment_id DESC";

$result = filterTable($query);  
}
else{
 $query = "SELECT * FROM professionalstable AS pt
RIGHT JOIN users AS us ON pt.user=us.username
RIGHT JOIN paymentstable AS pyt ON pt.user=pyt.user
WHERE pyt.account='registrations'

ORDER BY pyt.payment_id DESC";
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
      <th>Paid On</th>
      <th>Holder</th>
      <th>First Name</th>
      <th>Mobile</th>
      <th>Message</th>
      <th>Status</th>
      <th>PayHistory</th>
      <th colspan="2">Actions</th>
    </tr>
  </thead>
  <?php if($result->num_rows>0): ?>      
  <?php while($row = mysqli_fetch_array($result)): ?>
<!--if there are users, display them-->
  
    <tr>
    <td><?php echo $row['payment_id']; ?></td>
  <!-- <td>?php echo date("H:i d/m/Y", strtotime($row['add_date'])); ?></td>  -->
  
<td><?php echo date("H:i | d/m/Y", strtotime($row['add_date'])); ?></td>


      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['first_name']; ?> <?php echo $row['other_names']; ?></td>
      <td><?php echo $row['mobile_number']; ?></td>
      <td><?php echo $row['payment_message']; ?></td>
      <td> <span class="badge bg-secondary"><?php echo $row['payment_status']; ?></span> </td>

      <!--payment history will depend on username-->
      <td>
      <?php
      $getHistory=mysqli_query($link, "SELECT user,payment_message FROM paymentstable WHERE user='".$row['user']."' AND payment_message='success'  ");
      echo "<span class='badge bg-info'>";
      echo mysqli_num_rows($getHistory);
      echo "</span>";
      ?>
      </d>
      <!--end payment history-->


 <!--the action buttons-->  
 <td>
<a href="view-professional.php?viewProfessional=<?php echo $row['user_id']; ?>" class="badge bg-primary"> <i class="fa fa-eye">Holder</i></a></td>  
</td>
<!--the activate/deactivate has logics-->
<?php if($row['payment_status']=='active'): ?>
  <td>
<a href="dboperations.php?deActivatePayment=<?php echo $row['payment_id']; ?>" class="badge bg-warning" onclick="return confirm('This payment will be deactivated from use. Proceed?')" > <i class="fa fa-warning"> Reset Payment</i></a></td>  
</td>
<?php else: ?>
<td>
  <a href="dboperations.php?activatePayment=<?php echo $row['payment_id']; ?>" class="badge bg-success" onclick="return confirm('This payment will be set to active status and all previous payments deactivated. Proceed?')"> <i class="fa fa-check"> Activate Payment</i></a></td>  
</td>
    <?php endif; ?>
<!--end the activate/deactivate-->
<!--end the action-->    

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
