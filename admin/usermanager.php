<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
  

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
$query = "SELECT * FROM users WHERE 
username LIKE '%$searchValue%' 
OR email LIKE '%$searchValue%' 
OR user_type LIKE '%$searchValue%'
ORDER BY user_id DESC";

$result = filterTable($query);  
}
else{
 $query = "SELECT * FROM users ORDER BY user_id DESC";
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
      <th>User No.</th>
      <th>Login Name</th>
      <th>Email</th>
      <th>User Type</th>
      <th colspan="2">Actions</th>
    </tr>
  </thead>
  <?php if($result->num_rows>0): ?>      
  <?php while($row = mysqli_fetch_array($result)): ?>
<!--if there are users, display them-->
  
    <tr>
      <td><?php echo $row['user_id']; ?></td>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['user_type']; ?></td>

 <!--the action buttons depends on user role-->     
<?php if($row['user_type']=='admin'): ?>
<td>
<a href="" class="fa fa-ban badge bg-success inactive"> Reset pass</a>
</td>
<?php else: ?>
<td>
<a href="dboperations.php?resetPassWord=<?php echo $row['user_id']; ?>" class="fa fa-user-times badge bg-success" onclick="return confirm('You are about to reset password for this user')" > Reset pass</a>
</td>  
<?php endif; ?>  


<?php if($row['user_type']=='admin'): ?>
<td>
<a href="" class="fa fa-ban badge bg-danger inactive"> Delete</a>
</td>
<?php else: ?>
<td>
<a href="#" id="<?php echo $row['user_id']; ?>" class="openPopupBtn badge bg-danger fa fa-trash"> Delete</a></td>  
<?php endif; ?> 
<!--end the action buttons-->      

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

<!--require the modal-->
<?php require_once("modal-del-user.php"); ?>




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
