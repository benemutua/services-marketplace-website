<!--import the db file and session logics--->
<?php require_once("dboperations.php"); ?> 
<?php if(!$_SESSION['loggedin']){
  header("location: login.php");
  exit;
}
?> 

<?php if($_SESSION['role']!='admin'){
  header("location: error.php");
  exit;
}
?> 


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>Admin|</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  

  <!-- Bootstrap core CSS -->
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 


  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <link href="remixicon/remixicon.css" rel="stylesheet">

  <!--the jQuery CDN and my custom google div import --->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  

<!--custom jquery-->
<script src="lib/jquery/jquery-3.6.0.js"></script> 
</head>

<body>
  <section id="container">
   
      
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Collapse Menu"></div>
      </div>
      <!--logo start-->
      <a href="index.php"><b>BENESOFT ADMIN</b></a>
      <!--logo end-->
    
      
    </header>
    <!--header end-->
      
      
      
      
      
   
    <!--sidebar menu start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
         <!-- start of side menu items-->
            
         

                    <!--========================= 
                      THE LOGGED IN SESSION
                    ============================-->
          <li class="mt">
          <h6> <i class="fa fa-user"></i>
              <?php  if (isset($_SESSION['user'])) : ?>  
                    Hello:   
                    <?php echo $_SESSION['user']; ?> 
                  <?php endif ?>  
          </li> </h6>
     
            
            <!-- dashboard-->
          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
            
            <!-- system acs-->
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-group"></i>
              <span>System users</span>
              </a>
            <ul class="sub">
                <li><a href="adduser.php"><i class="fa fa-plus"></i>Add User</a></li>
                <li><a href="usermanager.php"><i class="fa fa-cogs"></i>Manage Users</a></li>
            </ul>
          </li>


            <!-- -------------professionals------------------------->
            <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-user"></i>
              <span>Service Providers</span>
              </a>
            <ul class="sub">
                <li><a href="add-professional.php"><i class="fa fa-plus"></i>Add Professional</a></li>
                <li><a href="account-delete.php"><i class="fa fa-trash"></i>Delete Account</a></li>
                <li><a href="account-verification.php"><i class="fa fa-check"></i>Account Verification</a></li>
                <li><a href="archive-accounts.php"><i class="fa fa-user-times"></i>Archive Accounts</a></li>
                <li><a href="account-manager.php"><i class="fa fa-cogs"></i>Manage Professionals</a></li>
            </ul>
          </li>
        
         

     <!-- payments-->
     <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-usd"></i>
              <span>Payments</span>
              </a>
            <ul class="sub">
                <li><a href="reg-payments.php"><i class="fa fa-table"></i>Registrations</a></li>
                <li><a href="boost-payment.php"><i class="fa fa-bullhorn"></i>A/c Boosting</a></li>
                <li><a href="payment-manager.php"><i class="fa fa-cogs"></i>Manage Payments</a></li>
                <li><a href="payments-report.php"><i class="fa fa-file-excel-o"></i>Payment Reports</a></li>
            </ul>
          </li>



           <!------------support------------>
     <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-volume-control-phone"></i>
              <span>Support</span>
              </a>
            <ul class="sub">
                <li><a href="messages-unread.php"><i class="fa fa-envelope"></i>Unread Messages</a></li>
                <li><a href="messages.php"><i class="fa fa-comments-o"></i>All Messages</a></li>
            </ul>
          </li>

        
        <!------------account management------------>
        <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cog"></i>
              <span>My Profile</span>
              </a>
            <ul class="sub">
                <li><a href="change-pass.php"><i class="fa fa-exchange"></i>Change Pass</a></li>
                <li><a href="myinfor.php"><i class="fa fa-file"></i>My info</a></li>
                <li><a href="signout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
            </ul>
          </li>


          
        <!-- sidebar menu end-->
             </ul>
               </div>
    </aside>
     
    <!--sidebar end-->


