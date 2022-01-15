<?php
require_once("db/config.php");
session_start();

//GLOBAL VARIABLES
$messageReceiver="";
$messageSender="";
$messageID="";







///USER LOGIN PART/////////////////////////////////////////////////////////////////////////////
if(isset($_POST['signinBtn'])){
    $user=mysqli_real_escape_string($link, $_POST['userName']);
    $pass=mysqli_real_escape_string($link, $_POST['passWord']);

//check from database if that user exists
	$sqlConfirmUser = "SELECT * FROM users WHERE username = '$user' AND user_type='admin' ";
	$resultConfirmUser = mysqli_query($link,$sqlConfirmUser);
	if(mysqli_num_rows($resultConfirmUser)==1){
        
        //if the user is found, now verify the pass algorith to see if the password matches
        while($rowUser=mysqli_fetch_assoc($resultConfirmUser)){
            $email= $rowUser['email'];
            $userType= $rowUser['user_type'];
            //see the pass
            if(password_verify($pass,$rowUser['password'])){
                //if the password is the same, now login and start session
             session_start();
             $_SESSION['loggedin']=true;
             $_SESSION['user']= $user;
             $_SESSION['email']= $email;
             $_SESSION['role']= $userType;

             //redirect user to the landing page
             $_SESSION['message'] = "Welcome to admin dashboard @".$_SESSION['user']. " ";
            header("location: index.php");

            }
            else{
                $_SESSION['err'] = "Mismatching Credentials!";  
                header('location: login.php');
            }//end checking for password match

        }

    }
    else{//if the user is not found,
        $_SESSION['err'] = "User does not exist!";  
		header('location: login.php');
    }//end confirming user existence
}/////END THE USER LOGIN PART//////////////////////////////////////////////////////////////





//USER CHANGE PASSWORD//////////////////////////////////////////////////////////////
if(isset($_POST['changeMyPassword'])){
    $oldPass=mysqli_real_escape_string($link,$_POST['oldPass']);
    $newPass=mysqli_real_escape_string($link,$_POST['newPass']);
    $confNewPass=mysqli_real_escape_string($link,$_POST['confNewPass']);
    $empty=NULL;
    
    //check for empty fields
    if(!($oldPass==$empty or $newPass==$empty or $confNewPass==$empty)){
    
    //if no empty, confirm if the old pass is really the right one
    $rstCheckUser=mysqli_query($link, "SELECT * FROM users WHERE username='".$_SESSION['user']."'");
    while($rowUserPass=mysqli_fetch_assoc($rstCheckUser)){
       
    //if the pass matches, now proceed to the next
    if(password_verify($oldPass,$rowUserPass['password'])){
    //now that pass matches, check if inputs of new pass and confirm pass match
    
    if($newPass==$confNewPass){
    //now that passwords match, do the changes/updates user 
    $options = array("cost"=>8);
    $hashedPassword = password_hash($newPass,PASSWORD_BCRYPT,$options);
    
    //check if the pass is less than 8 characters, deny entry
    if(!(strlen($newPass)<8)){
    //if the string length is more than 8 characters, proceed
        mysqli_query($link, "UPDATE users SET password='$hashedPassword' WHERE username='".$_SESSION['user']."' ");
        require_once("signout.php");
        
    }//end updating pass
    
    else{//show err that pass is too short
        $_SESSION['err']="Min password length is 8 characters";
        header("location: change-pass.php");
    }//end checking password length and insertion
    
    
    }
    else{//if the passwords fdont match, error out
        $_SESSION['err']="New pass & Confirm Pass do not match!";
        header("location: change-pass.php");
    }//end checking for match in passwords
    
    
    }
    else{//if pass does not match, deny changes
        $_SESSION['err']="Old Password is incorrect!";
        header("location: change-pass.php");
    }//end veruifying user poass
    
    }//end while for fetching the user pass
    
    }
    else{//error out if empty input detected
        $_SESSION['err']="All fields are mandatory!";
        header("location: change-pass.php");
    }//end checking for empty inputs
    
    
    }//END CHANGING PASSWORD//////////////////////////////////////////////////////////////





////REGISTER A NEW SYSTEM USER THROUGH ADMIIN PANEL //////////////////////////////////////////////////////////////
if(isset($_POST['addUser'])){
    $userName=mysqli_real_escape_string($link, $_POST['userName']);
    $email=mysqli_real_escape_string($link, $_POST['emailAddress']);
    $pass=mysqli_real_escape_string($link, $_POST['passWord']);
    $confPass=mysqli_real_escape_string($link, $_POST['confPassWord']);

    $options = array("cost"=>8);
    $hashPassword = password_hash($pass,PASSWORD_BCRYPT,$options);
    $empty= NULL;//for empty fields
    
    //check for empty inputs
    if(!($userName==$empty or $email==$empty or $pass==$empty or $confPass==$empty)){
    
    //check if the pass is less than 8 characters, deny entry
    if(!(strlen($pass)<8)){//if the string length is more than 8 characters, proceed
    
    
       
    //check if conf password and main passwords match
    if($pass==$confPass){
    
        //now check from users if there exists a duplicate entry 
        $sqlSearchUser="SELECT * FROM users WHERE username='$userName' OR email='$email' ";
        $resultUser=mysqli_query($link, $sqlSearchUser);
        //so
        if(mysqli_num_rows($resultUser)<1){
          //now insert user to database
     
         $sqlInsertUser="INSERT INTO users(username, email,password)VALUES ('$userName', '$email','$hashPassword')";
         $resultInsertUser=mysqli_query($link, $sqlInsertUser);
    
         if($resultInsertUser){//if insertion suceeds
            $_SESSION['message']="User Account created succesfully!";
            header("location: adduser.php");
         }
         else{//if insertion fails, error out
            $_SESSION['err']="Oops! something went wrong. try again";
            header("location: adduser.php"); 
         }//end inserting user
    
    
    
        }
        else{
            $_SESSION['err']="User is already registered";
            header("location: adduser.php");  
        }//end checking for duplicate entry
    
    
    }//if the 2 pass dont match, error out
    else{
        $_SESSION['err']="confirm password does not match the main password!";
        header("location: adduser.php");  
    }//end checking the password matching
    
    }
    else{
        $_SESSION['err']="Minimum pass length is 8! Try again";
        header("location: adduser.php");
    }//end checking the password length
    }
    else{//if fields are empty,
        $_SESSION['err']="All fields are mandatory!";
        header("location: adduser.php");
    }//end checking for empty inputs
    }//END THE USER REGISTRATION PART //////////////////////////////////////////////////////////////




/*------------------------------------------------------------------------------------------
MANAGE USERS/ DELETE PROFESSIONAL PAGE STARTS HERE
--------------------------------------------------------------------------------------------*/
//DELETE USER . THIS ALSO DELETES RECORDS ON PAYMENTS AND PROFESSIONAL TABLES
if(isset($_POST['deleteUserAc'])){
$userid=mysqli_real_escape_string($link,$_POST['getUserId']);
$empty=NULL;

//check for empty inputs
if(!($userid==$empty)){
//if not empty, check if user exists on system
$userExists=mysqli_query($link, "SELECT * FROM users WHERE user_id=$userid ");
if(mysqli_num_rows($userExists)>0){

while($rowUserData=mysqli_fetch_assoc($userExists)){
$userName=$rowUserData['username'];//vital as is used  on the other tables

//begin transaction to delete records on payments and professional table as well
// Switch on error reporting with exception mode
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Start transaction to delete all data
    $link->begin_transaction();

    $link->query("DELETE FROM professionalstable WHERE user='$userName' ");
    $link->query("DELETE FROM paymentstable WHERE user='$userName' ");
    $link->query("DELETE FROM users WHERE user_id=$userid");

    // if no error reported, commit the transactions
    $link->commit();
    $_SESSION['message']="User account and coresponding records have been deleted";
    header('Location: ' . $_SERVER['HTTP_REFERER']);

} catch (\Throwable $e) {// Something went wrong. Rollback
    $link->rollback();
    $_SESSION['err']="Oops! something went wrong. try again";
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
}///end the actual deletion


}//end while loop

}
else{//if user doesnt exist
    $_SESSION['err']="User error. Not found";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}///end checking user existence

}
else{//if the field is empty
    $_SESSION['err']="Undefined err occured";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}//end checking for empty input

}//END DELETE ACCOUNT INFO PART//////////////////////////////////////////////////////////////






//PROFESSIONALS PART
/////REGISTERING A PROFESSIONAL////////////////////////////////////////////////////////////////////
if(isset($_POST['submitRegistration'])){
    $title=mysqli_real_escape_string($link, $_POST['initials']);
    $accountHolder=mysqli_real_escape_string($link, $_POST['userName']);
    $firstName=mysqli_real_escape_string($link, $_POST['firstName']);
    $otherNames=mysqli_real_escape_string($link, $_POST['otherNames']);
    $mobileNumber=mysqli_real_escape_string($link, $_POST['mobileNumber']);
    $mobilePublic=mysqli_real_escape_string($link, $_POST['mobile_public']);
    $emailAddress=mysqli_real_escape_string($link, $_POST['email']);
    $profession=mysqli_real_escape_string($link, $_POST['professionField']);
    $speciality=mysqli_real_escape_string($link, $_POST['speciality']);
    $membership=mysqli_real_escape_string($link, $_POST['associations']);
    $about=mysqli_real_escape_string($link, $_POST['about']);
    $myLink=mysqli_real_escape_string($link, $_POST['myUrl']);
    $mobility=mysqli_real_escape_string($link, $_POST['mobility']);
    $accesibility=mysqli_real_escape_string($link, $_POST['accesibility']);
    $subscriptionSelect=mysqli_real_escape_string($link, $_POST['subscription']);
    $paymentNumber=mysqli_real_escape_string($link, $_POST['myPaymentNumber']);
    $paymentOption=mysqli_real_escape_string($link, $_POST['push_option']);
    $paymentAmount=mysqli_real_escape_string($link, $_POST['payAmount']);
    $empty=NULL;
    
    date_default_timezone_set('Africa/Nairobi');
    $add_date= date('Y-m-d H:i:s');
    
    if($subscriptionSelect=='2 months'){
        $sub_expiry= date('Y-m-d H:i:s', strtotime($add_date. ' + 60 days'));
        }
    elseif($subscriptionSelect=='4 months'){
        $sub_expiry= date('Y-m-d H:i:s', strtotime($add_date. ' + 120 days'));
    }
    elseif($subscriptionSelect=='6 months'){
        $sub_expiry= date('Y-m-d H:i:s', strtotime($add_date. ' + 180 days'));
    }
    elseif($subscriptionSelect=='12 months'){
        $sub_expiry= date('Y-m-d H:i:s', strtotime($add_date. ' + 360 days'));
    }
    else{
        echo "something went wrong. Contact system administrator for help 0708672495";
    }
    
    //check for empty inputs
    if(!($accountHolder==$empty or $firstName==$empty or $otherNames==$empty or $mobileNumber==$empty or $profession==$empty 
    or $speciality==$empty or $about==$empty or $mobility==$empty or $accesibility==$empty 
    or $subscriptionSelect==$empty)){
    
    //if no empty, check if that user is already on the system
    $resultSearchExistence=mysqli_query($link, "SELECT * FROM professionalstable WHERE user='".$_SESSION['user']."' ");
    if(mysqli_num_rows($resultSearchExistence)<1){
    
    //if no  matching records, insert the user into profile table and payments table at once
    // Switch on error reporting with exception mode
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    
    try {
        // Start transaction
        $link->begin_transaction();
    
        $link->query("INSERT INTO professionalstable(user,first_name,other_names,title,mobile_number, mobile_public,field,speciality,about,accesibility,mobility,associations,external_link,reg_date)
        VALUES ('$accountHolder', '$firstName', '$otherNames', '$title', '$mobileNumber', '$mobilePublic', '$profession', '$speciality', '$about', '$accesibility', '$mobility', '$membership', '$myLink','$add_date')");
        $link->query("INSERT INTO paymentstable(user,account, subscription_terms,paid_amount,add_date,expires_on) VALUES('$accountHolder','registrations', '$subscriptionSelect','$paymentAmount', '$add_date', '$sub_expiry')");
    
        // if no error reported, commit the transactions
        $link->commit();
        $_SESSION['message']="Profile created succesfully. visit <a href='#'>My Account</a> for more details";
        header("location: add-professional.php");
    
    } catch (\Throwable $e) {// Something went wrong. Rollback
        $link->rollback();
        $_SESSION['err']="Oops! something went wrong. try again";
        header("location: add-professional.php"); 
        //throw $e;
    }
    ///end the actual insertion
    
    
    
    }
    else{//if there is a match
        $_SESSION['err']="You can not add two users to the system. contact support on 0708672495!";
        header("location: add-professional.php");
    }//end checking user existence
    
    }//if there are empty fields, error out
    else{
        $_SESSION['err']="All fields are mandatory!";
        header("location: add-professional.php");
    }//end checking for empty inputs
    
    
    }//END PROFESSIONAL REGISTRATION///////////////////////////////////////////////////////////////////



//ARCHIVE TABLE
//UNDO DELETE/////////////////////////////////////////////////////////////////////
if(isset($_GET['undoDelete'])){
$profId=$_GET['undoDelete'];
//start the actual undo
$undoDeleteAc=mysqli_query($link, "UPDATE professionalstable SET delete_on=null, status='active' WHERE id=$profId ");
if($undoDeleteAc){
    $_SESSION['message']="Account delete action has been deactivated. Account is active!";
    header("location: archive-accounts.php");
}
else{
    $_SESSION['err']="Oops, something went wrong, try again!";
    header("location: archive-accounts.php");
}//end data update
}//end the account undo////////////////////////////////////////////////////////////////////////////



//UPDATE PROFESSIONAL DATA FROM VIEW-PROFESSIONAL PAGE////////////////////////////////////////////////////
if(isset($_POST['submitUpdateData'])){
    $title=mysqli_real_escape_string($link, $_POST['initials']);
    $accountHolder=mysqli_real_escape_string($link, $_POST['userName']);
    $firstName=mysqli_real_escape_string($link, $_POST['firstName']);
    $otherNames=mysqli_real_escape_string($link, $_POST['otherNames']);
    $mobileNumber=mysqli_real_escape_string($link, $_POST['mobileNumber']);
    $mobilePublic=mysqli_real_escape_string($link, $_POST['mobile_public']);
    $emailAddress=mysqli_real_escape_string($link, $_POST['email']);
    $profession=mysqli_real_escape_string($link, $_POST['professionField']);
    $speciality=mysqli_real_escape_string($link, $_POST['speciality']);
    $membership=mysqli_real_escape_string($link, $_POST['associations']);
    $about=mysqli_real_escape_string($link, $_POST['about']);
    $myLink=mysqli_real_escape_string($link, $_POST['myUrl']);
    $mobility=mysqli_real_escape_string($link, $_POST['mobility']);
    $accesibility=mysqli_real_escape_string($link, $_POST['accesibility']);
    $accountStatus=mysqli_real_escape_string($link, $_POST['userStatus']);
    $verificationStatus=mysqli_real_escape_string($link, $_POST['verification']);
    $empty=NULL;    

    if(!($firstName==$empty or $otherNames==$empty or $mobileNumber==$empty or $profession==$empty 
    or $speciality==$empty or $about==$empty or $mobility==$empty or $accesibility==$empty )){
//if no empty, proceed to update
$updateProfessionalData=mysqli_query($link, "UPDATE professionalstable SET title='$title', first_name='$firstName',
other_names='$otherNames', mobile_number='$mobileNumber', field='$profession', speciality='$speciality',
associations='$membership', about='$about', external_link='$myLink',status='$accountStatus', verification='$verificationStatus', mobility='$mobility', accesibility='$accesibility' WHERE user='$accountHolder' ");

if($updateProfessionalData){//if the update ran succesfully, show message
    $_SESSION['message']="client data updated succesfully.!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{//if updat efailed
    $_SESSION['err']="Oops, something went wrong, try again!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}//end update

    }
    else{//error out if empoty detected
        $_SESSION['err']="Empty fields detected";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }//end checking empty inputs

}//end the professional update///////////////////////////////////////////////////////////////




//VERIFY PROFESSIONALS DIRECT//////////////////////////////////////////////////////////////////
if(isset($_GET['verifyProfessional'])){
$userAccount=$_GET['verifyProfessional'];

//now verify
$verifyData=mysqli_query($link, "UPDATE professionalstable SET verification='verified' WHERE user='$userAccount' ");
if($verifyData){//if verification went thro'
    $_SESSION['message']="Account has been verified!!";
    header('Location: account-verification.php');
}
else{//if verify failed
    $_SESSION['err']="Oops, something went wrong!!";
    header('Location: account-verification.php');
}//end the verification
}//END VERIFYING PROFESSIONALS////////////////////////////////////////////////////////



//UNVERIFY PROFESSIONALS DIRECT/////////////////////////////////////////////////////////
if(isset($_GET['unVerifyProfessional'])){
    $userAccount=$_GET['unVerifyProfessional'];
    
    //now verify
    $verifyData=mysqli_query($link, "UPDATE professionalstable SET verification='unverified' WHERE user='$userAccount' ");
    if($verifyData){//if verification went thro'
        $_SESSION['message']="Account has been verified!!";
        header('Location: account-verification.php');
    }
    else{//if verify failed
        $_SESSION['err']="Oops, something went wrong!!";
        header('Location: account-verification.php');
    }//end the verification check
    
    }//END UNVERIFYING PROFESSIONALS////////////////////////////////////////////////////////////






//ACTIVATE PAYMENT///////////////////////////////////////////////////////////////////////////
//the logic is that
//1. if date has passed, you can not activate the payment
//2. if there is an active account existing, it will be deactivated automatically and the latest one becomes active
if(isset($_GET['activatePayment'])){
$paymentId=$_GET['activatePayment'];

//get the username for that transaction
$userIs=mysqli_query($link, "SELECT payment_id,user FROM paymentstable WHERE payment_id=$paymentId ");
$row=mysqli_fetch_assoc($userIs); 
$holderUser=$row['user'];//this is the username of that account

//check if the expiry date has p[assed]
$sqlCheckDate=mysqli_query($link, "SELECT * FROM paymentstable WHERE payment_id=$paymentId");
while($rowExpiry=mysqli_fetch_assoc($sqlCheckDate)){
date_default_timezone_set('Africa/Nairobi');
$date_now = date("Y-m-d"); // this format is string comparable
$dbData= date("Y-m-d", strtotime($rowExpiry['expires_on']));

if($date_now<=$dbData){
//if expiry date is far, check if there is any other active payment, if found , deactivate it asap
$cancelActiveStatus=mysqli_query($link, "UPDATE paymentstable SET payment_status='inactive' WHERE user='$holderUser' AND payment_status='active' ");
//after the cancelation, now proceed to activating the other one
if($cancelActiveStatus){

$activatePay=mysqli_query($link, "UPDATE paymentstable SET payment_status='active', payment_message='success' WHERE payment_id=$paymentId ");
if($activatePay){
$_SESSION['message']="<ul>
<span class='fa fa-info'> Changes that have been effected</span>
<li>All preceeding payments set to inactive</li>
<li>Payment account activated successfully!</li></ul>";
header('Location: reg-payments.php');

}//end if block for cecking succcessful activation of payment
else{//if filed, error out
$_SESSION['err']="Oops, something went wrong!!";
header('Location: reg-payments.php');
}//end checking if query for activate payment ran success


}//end if block statement for canceling active status
else{//if canceling active status failed
    $_SESSION['err']="Oops, something went wrong!!";
    header('Location: reg-payments.php');
}//end checking if canceling acticve status ran success


}//end if statement
else{//if the expiry date has passed, erro out
$_SESSION['err']="This payment has expired already and cannot be updated!";
header('Location: reg-payments.php');
}//end checking expiry date

}//end the while loop for getting each row

}//end the activate payment button//////////////////////////////////////////////////




//DEACTIVATE PAYMENT///////////////////////////////////////////////////////////
if(isset($_GET['deActivatePayment'])){
$paymentId=$_GET['deActivatePayment'];

//sql
$deactivatePay=mysqli_query($link, "UPDATE paymentstable SET payment_status='inactive' WHERE payment_id=$paymentId ");
if($deactivatePay){
    $_SESSION['message']="Payment account deactivated successfully!";
    header('Location: reg-payments.php');
}
else{//if filed, error out
    $_SESSION['err']="Oops, something went wrong!!";
        header('Location: reg-payments.php');
}//end checking the query status
}//end the deactivate payment button///////////////////////////////////////////////////









//ON THE MANAGE PAYMENTS PAGE///////////////////////////////////////////////
//BULK DELETE BUTTON
if(isset($_POST['bulkDeletePayments'])){
    $chkarr= $_POST['checkbox'];

foreach ((array) $chkarr as $id){
    $sql="DELETE FROM paymentstable WHERE payment_id=$id";
    if(mysqli_query($link, $sql)){
      $_SESSION['message'] = "Selected payments removed succesfully";  
          header('location: payment-manager.php');  
         }
          else{
            $_SESSION['err'] = "Bulk action not performed";  
          header('location: payment-manager.php');  
          }
      }
}//END THE BULK PAYMENT DELETE//////////////////////////////////////////////////////////////







//DELETE PAYMENT FROM THE INLINE BUTTON//////////////////////////////////////////////////////////////
if(isset($_GET['delPayments'])){
$payID=$_GET['delPayments'];

$delPayments=mysqli_query($link, "DELETE FROM paymentstable WHERE payment_id=$payID ");
if($delPayments){
$_SESSION['message']="Successfully deleted payment data ID $payID ";
header("location: payment-manager.php");
}
else{//if something went wrong. eeror out
    $_SESSION['err']="Oops,something went wrong and data could not be deleted. try again later";
    header("location: payment-manager.php");
}//end checking data deletion

}//end the inline delete button//////////////////////////////////////////////////////////////

////END THE MANAGE PAYMENTS PAGE/////////////////////////////////////////////////////////////////////













//THE PRINT BUTTON ON MANAGE PAYMENTS PAGE/////////////////////////////////////////////
if(isset($_GET['printUserStatements'])){
    $paymentsID=$_GET['printUserStatements'];
//get the user to which the id belongs
$getUser=mysqli_query($link, "SELECT payment_id,user FROM paymentstable WHERE payment_id=$paymentsID ");
$row=mysqli_fetch_assoc($getUser); 
$theUser=$row['user'];//this is the username of that account

//now that we have the user, lets go ahead and print all statements in EXCEL related to them
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "$theUser-payments-report-" . date('Y-m-d') . ".xls"; 
 
//Customize the column names 
$fields = array('PAYNO.', 'ACCOUNT', 'TERMS', 'AMOUNT', 'PAY CODE', 'PAY DATE', 'EXPIRY'); 
$company=array("", "","BENESOFTKE SOLUTIONS LTD");
$accountHolder=array("", "ACCOUNT HOLDER:: $theUser --(ALL PAYMENTS AVAILABLE)");
$emptyCell=array("");

// Display column names as first row 
$excelData  = implode("\t", array_values($emptyCell)) . "\n"; 
$excelData .= implode("\t", array_values($company)) . "\n";
$excelData .= implode("\t", array_values($accountHolder)) . "\n"; 

$excelData .= implode("\t", array_values($emptyCell)) . "\n"; 
$excelData .= implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $link->query("SELECT * FROM paymentstable WHERE user='$theUser' "); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ //start while loop
        $lineData = array($row['payment_id'], $row['account'], $row['subscription_terms'], $row['paid_amount'], $row['payment_message'], $row['add_date'], $row['expires_on']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } //end while loop

}//end the first if block
else{ //else if no records found
    $excelData .= 'Oops, something went wrong.please try again later...'. "\n"; 
} //end checking for records available
 
// Headers for downloading the excel 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
exit;
}//END EXPORTING excel STATEMENTS FROM MANAGE PAYMENTS PAGE/////////////////////////////////////////////////







//THE PAYMENT REPORT PAGE////////////////////////////////////////////////////////////////////
//general reports
//THE PRINT EXCEL DOCUMENT OF THE STATEMENTS/REPORT ////////////////////
if(isset($_POST['excelGeneralReport'])){
$accountType=mysqli_real_escape_string($link, $_POST['accountType']);
$startDate=mysqli_real_escape_string($link, $_POST['startDate']);
$endDate=mysqli_real_escape_string($link, $_POST['endDate']);

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Payments-excel-report-" . date('Y-m-d') . ".xls"; 
 
//Customize the column names 
$fields = array('PAYNO.', 'ACCOUNT', 'TERMS', 'AMOUNT', 'PAY CODE', 'PAY DATE', 'EXPIRY'); 
$company=array("", "","BENESOFTKE SOLUTIONS LTD");
$reportType=array("", "GENERAL REPORT //ACCOUNT:- $accountType ");
$dates=array("", "DATES FROM: $startDate TO: $endDate");
$emptyCell=array("");

// Display column names as first row 
$excelData  = implode("\t", array_values($emptyCell)) . "\n"; 
$excelData .= implode("\t", array_values($company)) . "\n";
$excelData .= implode("\t", array_values($emptyCell)) . "\n";
$excelData .= implode("\t", array_values($reportType)) . "\n";  
$excelData .= implode("\t", array_values($dates)) . "\n"; 
$excelData .= implode("\t", array_values($emptyCell)) . "\n"; 
$excelData .= implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $link->query("SELECT * FROM paymentstable WHERE account='$accountType' AND add_date>='$startDate' AND add_date<='$endDate' "); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ //start while loop
        $lineData = array($row['payment_id'], $row['account'], $row['subscription_terms'], $row['paid_amount'], $row['payment_message'], $row['add_date'], $row['expires_on']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } //end while loop

}//end the first if block
else{ //else if no records found
    $excelData .= 'No records found...'. "\n"; 
} //end checking for records available
 
// Headers for downloading the excel 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
exit;
}//END THE PRINT EXCEL REPORT for general/////////////////////////////////////////////////////////






//THE PRINT PDF REPORT FOR GENERAL REPORT//////////////////////////////////////////////////////
if(isset($_POST['pdfGeneralReport'])){
    $accountType=mysqli_real_escape_string($link,$_POST['accountType']); 
    $startDate=mysqli_real_escape_string($link,$_POST['startDate']); 
    $endDate=mysqli_real_escape_string($link,$_POST['endDate']);  
function fetch_data()  
{  
    require("db/config.php");
    $accountType=mysqli_real_escape_string($link,$_POST['accountType']); 
    $startDate=mysqli_real_escape_string($link,$_POST['startDate']); 
    $endDate=mysqli_real_escape_string($link,$_POST['endDate']); 

     $output = '';   
    
     $sql = "SELECT * FROM paymentstable WHERE account='$accountType' AND add_date>='$startDate' AND add_date<='$endDate' ";  
     $result = mysqli_query($link, $sql); 
     if(mysqli_num_rows($result)>0){ 
     while($row = mysqli_fetch_array($result))  
     {       
     $output .= '<tr>  
                         <td>'.$row["payment_id"].'</td>  
                         <td>'.$row["account"].'</td>  
                         <td>'.$row["subscription_terms"].'</td>  
                         <td>'.$row["paid_amount"].'</td>  
                         <td>'.$row["payment_message"].'</td> 
                         <td>'.$row["add_date"].'</td> 
                         <td>'.$row["expires_on"].'</td>  
                    </tr>  
                         ';  
     } //end while loop
    }//end if statement block
    else{//if there are no records
        $output .= '<tr> 
        <td colspan="7"> No records found for the search....</td>
        </tr>';
    } //end checking records availablility
     return $output;  
}

require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
    
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('times', '', 12);   
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h3 align="center"><img src="img/favicon.png"><br>BENESOFTKE LTD</h3><br /><br /> 
GENERAL REPORT FOR ACCOUNT #'.$accountType.'# ||  
DATE FROM: '.$startDate.' TO '.$endDate.' 
<br><br>

      <table>  
           <tr>  
                <th width="60px">PAYNO.</th>  
                <th>ACCOUNT</th>  
                <th>TERMS</th>  
                <th>AMOUNT</th>  
                <th>PAYCODE</th> 
                <th>ADD DATE</th>
                <th>EXPIRY</th> 
           </tr> 
           
           
      
           <style>
           span{
               color:#2ECC71; 
           }
    
           table{
               border-right:1px solid #2ECC71;
               border-left:1px solid #2ECC71;
               width:100%;
           }
           th{
            border:1px solid #2ECC71;
            color:white;
            background-color:#2ECC71;
            height:25px;
            text-align:center;
           }
           td{
            border-bottom:1px solid #2ECC71;
            height:20px;
            color: #5F6A6A;
            border-left:1px solid #2ECC71;
           }
           h3{
               color: #2ECC71;
               margin-bottom: -10px;
            }
    
    
           </style>
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->setPageOrientation('l');
      $obj_pdf->writeHTML($content);  
      
      $obj_pdf->Output('General report-'.date("Y-m-d").'.pdf', 'I');
}//end printing general report in pdf

//END THE GENERAL REPORT PAGE/////////////////////////////////////////////////////////












//THE INDIVIDUAL REPORT//////////////////////////////////////////////////////////////
//EXCELL REPORT
if(isset($_POST['excelIndividualReport'])){

    $accountType=mysqli_real_escape_string($link, $_POST['accountType']);
    $startDate=mysqli_real_escape_string($link, $_POST['startDate']);
    $endDate=mysqli_real_escape_string($link, $_POST['endDate']);
    $user=mysqli_real_escape_string($link, $_POST['userHolder']);
    
    // Filter the excel data 
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
     
    // Excel file name for download 
    $fileName = "Payments-excel-report-" . date('Y-m-d') . ".xls"; 
     
    //Customize the column names 
    $fields = array('PAYNO.', 'ACCOUNT', 'TERMS', 'AMOUNT', 'PAY CODE', 'PAY DATE', 'EXPIRY'); 
    $company=array("", "","BENESOFTKE SOLUTIONS LTD");
    $reportType=array("", "$user $accountType Payments Report");
    $dates=array("", "DATES FROM: $startDate TO: $endDate");
    $emptyCell=array("");
    
    // Display column names as first row 
    $excelData  = implode("\t", array_values($emptyCell)) . "\n"; 
    $excelData .= implode("\t", array_values($company)) . "\n";
    $excelData .= implode("\t", array_values($emptyCell)) . "\n";
    $excelData .= implode("\t", array_values($reportType)) . "\n";  
    $excelData .= implode("\t", array_values($dates)) . "\n"; 
    $excelData .= implode("\t", array_values($emptyCell)) . "\n"; 
    $excelData .= implode("\t", array_values($fields)) . "\n"; 
     
    // Fetch records from database 
    $query = $link->query("SELECT * FROM paymentstable WHERE user='$user' AND account='$accountType' AND add_date>='$startDate' AND add_date<='$endDate' "); 
    if($query->num_rows > 0){ 
        // Output each row of the data 
        while($row = $query->fetch_assoc()){ //start while loop
            $lineData = array($row['payment_id'], $row['account'], $row['subscription_terms'], $row['paid_amount'], $row['payment_message'], $row['add_date'], $row['expires_on']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        } //end while loop
    
    }//end the first if block
    else{ //else if no records found
        $excelData .= 'No records found or such user does not exist...'. "\n"; 
    } //end checking for records available
     
    // Headers for downloading the excel 
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
     
    // Render excel data 
    echo $excelData; 
    exit;

}//END EXCEL REPORT FOR INDIVIDUAL//////////////////////////////////////////////////////////////










//PDF REPORT FOR INDIVIDUAL//////////////////////////////////////////////////////////
if(isset($_POST['pdfIndividualReport'])){
    $accountType=mysqli_real_escape_string($link, $_POST['accountType']);
    $startDate=mysqli_real_escape_string($link, $_POST['startDate']);
    $endDate=mysqli_real_escape_string($link, $_POST['endDate']);
    $user=mysqli_real_escape_string($link, $_POST['userHolder']);
function fetch_data()  
{  
    require("db/config.php");
    $accountType=mysqli_real_escape_string($link, $_POST['accountType']);
    $startDate=mysqli_real_escape_string($link, $_POST['startDate']);
    $endDate=mysqli_real_escape_string($link, $_POST['endDate']);
    $user=mysqli_real_escape_string($link, $_POST['userHolder']);

     $output = '';   
    
     $sql = "SELECT * FROM paymentstable WHERE account='$accountType' AND user='$user' AND add_date>='$startDate' AND add_date<='$endDate' ";  
     $result = mysqli_query($link, $sql); 
     if(mysqli_num_rows($result)>0){ 
     while($row = mysqli_fetch_array($result))  
     {       
     $output .= '<tr>  
                         <td>'.$row["payment_id"].'</td>  
                         <td>'.$row["account"].'</td>  
                         <td>'.$row["subscription_terms"].'</td>  
                         <td>'.$row["paid_amount"].'</td>  
                         <td>'.$row["payment_message"].'</td> 
                         <td>'.$row["payment_status"].'</td> 
                         <td>'.$row["add_date"].'</td> 
                         <td>'.$row["expires_on"].'</td>  
                    </tr>  
                         ';  
     } //end while loop
    }//end if statement block
    else{//if there are no records
        $output .= '<tr> 
        <td colspan="7"> No records found for the search....</td>
        </tr>';
    } //end checking records availablility
     return $output;  
}

require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
    
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('times', '', 12);   
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
<h3 align="center"><img src="img/favicon.png"><br>BENESOFTKE LTD</h3><br /><br /> 
GENERAL REPORT FOR ACCOUNT #<span>'.$accountType.'</span>  || HOLDER #<span>'.$user.'</span> <br> 
DATE FROM: <span>'.$startDate.'</span> TO <span>'.$endDate.'</span> 
<br><br>

      <table>  
           <tr>  
           <th width="60px">PAYNO.</th>  
           <th>ACCOUNT</th>  
           <th>TERMS</th>  
           <th>AMOUNT</th>  
           <th>PAYCODE</th> 
           <th>STATUS NOW</th>
           <th>ADD DATE</th>
           <th>EXPIRY</th> 
           </tr> 
           
           
           <style>
           span{
               color:#2ECC71; 
           }
    
           table{
               border-right:1px solid #2ECC71;
               border-left:1px solid #2ECC71;
               width:100%;
           }
           th{
            border:1px solid #2ECC71;
            color:white;
            background-color:#2ECC71;
            height:25px;
            text-align:center;
           }
           td{
            border-bottom:1px solid #2ECC71;
            height:20px;
            color: #5F6A6A;
            border-left:1px solid #2ECC71;
           }
           h3{
               color: #2ECC71;
               margin-bottom: -10px;
            }
    
    
           </style>
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->setPageOrientation('l');
      $obj_pdf->writeHTML($content);  
      
      $obj_pdf->Output('report-'.date("Y-m-d").'.pdf', 'I');
}//END PDF REPORT FOR INDIVIDUAL




//THE MAILING INDUIVIDUAL REPORT DIRECTLY TO CLIENT
if(isset($_POST['emailClient'])){

}//END MAILING pdf REPORT TO CLIENT


//END THE PAYMENTS REPORT PAGE















//THE SUPPORT PART
///WHEN REPLYING. WHEN THE REPLY MESSAGE BUTTON IS CLICKED A MESSAGE
if(isset($_GET['seeMessage'])){
$id= $_GET['seeMessage']; 
$sqlReplyMessage="SELECT * FROM chatbot WHERE message_id=$id";
$n = mysqli_query($link, $sqlReplyMessage);
    
if(count((is_countable($n)?$n:[1]))){
 $row = mysqli_fetch_array($n);
 $messageSender=$row['message_from'];
 $messageReceiver = $row['message_to'];
 $messageID=$row['message_id'];
       
//NOW UPDATE THE MESSAGE TO READ
if($row['status']=='delivered'){//if the statuses are not origination from support, or have not yet been replied to, update them to read 
mysqli_query($link, "UPDATE chatbot SET status='read' WHERE message_id=$id ");
}//end the updating query  
}//end the original if block

}//end the view message button







//NOW REPLY TO THE MESSAGE
if(isset($_POST['submit'])){
$message=mysqli_real_escape_string($link, $_POST['messageBody']);
$encodedMessage = str_rot13($message);//encode the essage before saving
$receiver=mysqli_real_escape_string($link, $_POST['replyTo']);
$messageNo=mysqli_real_escape_string($link, $_POST['messageID']);


//begin transaction fro updating the message status and inserting another message
  // Switch on error reporting with exception mode
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    
  try {
      // Start transaction
      $link->begin_transaction();
  
      $link->query("UPDATE chatbot SET status='replied' WHERE message_id=$messageNo ");
      $link->query("INSERT INTO chatbot(message_from, message_to, message_context, status) 
      VALUES('support', '$receiver', '$encodedMessage', 'sent') ");
  
      // if no error reported, commit the transactions
      $link->commit();
     header("location: messages.php");
  
  } catch (\Throwable $e) {// Something went wrong. Rollback
      $link->rollback();
      $_SESSION['err']="Oops! something went wrong. try again";
      header("location: messages.php"); 
      //throw $e;
  }
}//end message reply



?>