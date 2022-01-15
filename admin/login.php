<!--import the db file and session logics--->
<?php require_once("dboperations.php"); ?> 
<?php if(isset($_SESSION['loggedin'])){
  header("location: index.php");
  exit;
}
?> 


<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Admin|Home</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  
    <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
 
</head>

<body>


<div class="loginContainer"><!--end the login container-->

<h5> <i class="fa fa-lock"></i> ADMIN LOGIN</h5>


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







<form action="dboperations.php" method="post"><!--start the login form-->
<label for="">Admin Username</label>
<input type="text" name="userName" value="" placeholder="Enter admin username" class="form-control" >

<label for="">Admin Password</label>
<input type="password" name="passWord" value="" placeholder="Admin password" class="form-control mb-3" >

<p>Forgot password? <a href="forgotpass.php">Reset Here</a></p> 

<button type="submit" name="signinBtn" class="btn btn-success fa fa-sign-out">Login</button>
</form><!--end the form-->

</div><!--end the login container-->








</body>
</html>