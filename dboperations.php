<?php
require_once("assets/db/config.php"); 
session_start();



//the default time zone is global to the whole document
date_default_timezone_set('Africa/Nairobi');

////USER REGSTRATION PART/////////////////////////////////////////////////////////////////////////
if(isset($_POST['signupBtn'])){
$userName=mysqli_real_escape_string($link, $_POST['userName']);
$email=mysqli_real_escape_string($link, $_POST['email']);
$pass=mysqli_real_escape_string($link, $_POST['password']);
$confPass=mysqli_real_escape_string($link, $_POST['confPassword']);
$options = array("cost"=>8);
$hashPassword = password_hash($pass,PASSWORD_BCRYPT,$options);
$empty= NULL;//for empty fields

//check for empty inputs
if(!($_POST['userName']==$empty or $_POST['email']==$empty or $_POST['password']==$empty or $_POST['confPassword']==$empty)){

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
        $_SESSION['message']="Account created succesfully!";
        header("location: signup.php");
     }
     else{//if insertion fails, error out
        $_SESSION['err']="Oops! something went wrong. try again";
        header("location: signup.php"); 
     }//end inserting user



    }
    else{
        $_SESSION['err']="User exists! Go to login";
        header("location: signup.php");  
    }//end checking for duplicate entry


}//if the 2 pass dont match, error out
else{
    $_SESSION['err']="confirm password does not match the main password!";
    header("location: signup.php");  
}//end checking the password matching
 


}
else{
    $_SESSION['err']="Minimum pass length is 8! Try again";
    header("location: signup.php");
}//end checking the password length


}
else{//if fields are empty,
    $_SESSION['err']="All fields are mandatory!";
    header("location: signup.php");
}//end checking for empty inputs
}//END THE USER REGISTRATION PART////////////////////////////////////////////////////////////////////





///USER LOGIN PART/////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['signinBtn'])){
    $user=mysqli_real_escape_string($link, $_POST['userName']);
    $pass=mysqli_real_escape_string($link, $_POST['passWord']);

//check from database if that user exists
	$sqlConfirmUser = "SELECT * FROM users WHERE username = '$user' ";
	$resultConfirmUser = mysqli_query($link,$sqlConfirmUser);
	if(mysqli_num_rows($resultConfirmUser)==1){
        
        //if the user is found, now verify the pass algorith to see if the password matches
        while($rowUser=mysqli_fetch_assoc($resultConfirmUser)){
            $email= $rowUser['email'];
            //see the pass
            if(password_verify($pass,$rowUser['password'])){
                //if the password is the same, now login and start session
             session_start();
             $_SESSION['loggedin']=true;
             $_SESSION['user']= $user;
             $_SESSION['email']= $email;

             //redirect user to the landing page
             $_SESSION['message'] = "Welcome to management wizard @ ".$_SESSION['user']. " ";
            header("location: manageaccount.php");

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
}/////END THE USER LOGIN PART////////////////////////////////////////////////////////////////////////////







/////////////////////////////////////////////////////////////////////////////////////////////////////////
//USER CHANGE PASSWORD
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
    header("location: changepass.php");
}//end checking password length and insertion


}
else{//if the passwords fdont match, error out
    $_SESSION['err']="New pass & Confirm Pass do not match!";
    header("location: changepass.php");
}//end checking for match in passwords


}
else{//if pass does not match, deny changes
    $_SESSION['err']="Old Password is incorrect!";
    header("location: changepass.php");
}//end veruifying user poass

}//end while for fetching the user pass

}
else{//error out if empty input detected
    $_SESSION['err']="All fields are mandatory!";
    header("location: changepass.php");
}//end checking for empty inputs


}//END CHANGING PASSWORD//////////////////////////////////////////////////////////////////////////

















////ACCOUNT MANAGEMENT BY INDIVIDUALS


/*----------------------------------------------------------------------
user insert image on the manafge account page
-------------------------------------------------------------------------*/

if(isset($_POST['insertImage'])){

    $file =$_FILES['image'];
    $fileName=$_FILES['image']['name'];
    $fileTmpName=$_FILES['image']['tmp_name'];
    $fileSize=$_FILES['image']['size'];
    $fileError=$_FILES['image']['error'];
    $fileType=$_FILES['image']['type'];
    $fileExt= explode(".", $fileName);
    $fileActualExt =strtolower(end($fileExt));
    $allowed=array('jpeg','jpg','png');
    $fileNameNew=uniqid('',true)."Prof".".".$fileActualExt;
    $fileDestination = "uploads/profiles/".$fileNameNew;
    
    if(in_array($fileActualExt, $allowed)){//if file passes the extension check?
    //now check if there was an error in the file
    if($fileError===0){
    
    //now check if it meets size specifications max 8mb
    if($fileSize<=8000000){
    //now perform data insertion to database
    $sqlinsimage=mysqli_query($link,"INSERT INTO images(image_category,unique_owner,image_name) 
    VALUES('profile', '".$_SESSION['user']."', '$fileNameNew')");
    move_uploaded_file($fileTmpName,$fileDestination);//moves the file to the specified folder
    
    header("location: manageaccount.php");
    }
    else{//if the file is larger or smaller than required size
    $_SESSION['err']="only images between 2 and 8mb are allowed. image not inserted but other records were inserted";
    header("location: signup.php");
    }
    
    }
    else{//if the file has an error
    $_SESSION['err']="The upload file is corrupted and could not be inserted. however the other details were inserteds";
    header("location: signup.php");
    }
    
    }
    else{//if extension is wrong?
    $_SESSION['err']="The uploded file is not an image and could not be inserted";
    header("location: signup.php");
    }
    
    }
    /*---------------------------------------------------------------------
    end inserting image
    -------------------------------------------------------------------- */
    






/////REGISTERING A PROFESSIONAL/service/////////////////////////////////////////////////////////////////
if(isset($_POST['submitRegistration'])){
$title=mysqli_real_escape_string($link, $_POST['initials']);
$firstName=mysqli_real_escape_string($link, $_POST['fname']);
$otherNames=mysqli_real_escape_string($link, $_POST['sname']);
$mobileNumber=mysqli_real_escape_string($link, $_POST['mobile']);
$mobilePublic=mysqli_real_escape_string($link, $_POST['publicAccess']);
$emailAddress=mysqli_real_escape_string($link, $_POST['email']);
$profession=mysqli_real_escape_string($link, $_POST['professionField']);
$speciality=mysqli_real_escape_string($link, $_POST['specialityField']);
$membership=mysqli_real_escape_string($link, $_POST['associations']);
$about=mysqli_real_escape_string($link, $_POST['about']);
$myLink=mysqli_real_escape_string($link, $_POST['myUrl']);
$mobility=mysqli_real_escape_string($link, $_POST['mobility']);
$accesibility=mysqli_real_escape_string($link, $_POST['accesibility']);
$subscriptionSelect=mysqli_real_escape_string($link, $_POST['subscription']);
$paymentNumber=mysqli_real_escape_string($link, $_POST['myPaymentNumber']);
$paymentOption=mysqli_real_escape_string($link, $_POST['push_option']);
$payableAmount=mysqli_real_escape_string($link, $_POST['payableAmount']);
$empty=NULL;


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
if(!($firstName==$empty or $otherNames==$empty or $mobileNumber==$empty or $profession==$empty 
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
    VALUES ('".$_SESSION['user']."', '$firstName', '$otherNames', '$title', '$mobileNumber', '$mobilePublic', '$profession', '$speciality', '$about', '$accesibility', '$mobility', '$membership', '$myLink','$add_date')");
    $link->query("INSERT INTO paymentstable(user,account, subscription_terms,paid_amount,add_date,expires_on) VALUES('".$_SESSION['user']."', 'registrations', '$subscriptionSelect','$payableAmount', '$add_date', '$sub_expiry')");

    // if no error reported, commit the transactions
    $link->commit();
    $_SESSION['message']="Profile created succesfully. visit <a href='manageaccount.php'>My Account</a> for more details";
    header("location: registrations.php");

} catch (\Throwable $e) {// Something went wrong. Rollback
    $link->rollback();
    $_SESSION['err']="Oops! something went wrong. try again";
    header("location: registrations.php"); 
    //throw $e;
}
///end the actual insertion



}
else{//if there is a match
    $_SESSION['err']="You can not add two users to the system. contact support on 0708672495!";
    header("location: registrations.php");
}//end checking user existence

}//if there are empty fields, error out
else{
    $_SESSION['err']="All fields are mandatory!";
    header("location: registrations.php");
}//end checking for empty inputs


}//END PROFESSIONAL REGISTRATION/////////////////////////////////////////////////////////////////////





//UPDATE USER INFO///////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['updateRecordsBtn'])){
$mobility=mysqli_real_escape_string($link, $_POST['mobility']);
$accesibility=mysqli_real_escape_string($link, $_POST['accesibility']);
$speciality=mysqli_real_escape_string($link, $_POST['speciality']);
$about=mysqli_real_escape_string($link, $_POST['about']);
$phone=mysqli_real_escape_string($link, $_POST['mobileNumber']);
$email=mysqli_real_escape_string($link, $_POST['emailAddress']);
$associations=mysqli_real_escape_string($link, $_POST['associations']);
$myLink=mysqli_real_escape_string($link, $_POST['myUrl']);
$field=mysqli_real_escape_string($link, $_POST['myField']);
$empty=NULL;

//check for empty inputs
if(!($phone==$empty or $email==$empty or $about==$empty or $speciality==$empty or $field==$empty)){
// if no empty fields, now proceed

        // Switch on error reporting with exception mode
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            // Start transaction
            $link->begin_transaction();
            $link->query("UPDATE professionalstable SET
            mobility='$mobility' , associations='$associations', external_link='$myLink',  accesibility='$accesibility', about='$about', speciality='$speciality', mobile_number='$phone' 
            WHERE user='".$_SESSION['user']."' ");

            $link->query("UPDATE users SET email='$email' WHERE username='".$_SESSION['user']."' ");
            // if no error reported, commit the transactions
            $link->commit();
            $_SESSION['message']="Profile Records updated.";
            header("location: manageaccount.php");

           } 
            catch (\Throwable $e) {// Something went wrong. Rollback
            $link->rollback();
            $_SESSION['err']="Oops! something went wrong. try again";
            header("location: manageaccount.php"); 
            //throw $e;
           }///end the profiel update
}/////
else{//error out if empty detected
    $_SESSION['err']="All fields are mandatory!";
    header("location: manageaccount.php");
}//END CHECKING EMPTY FIELDS

}//END UPDATING USER INFO///////////////////////////////////////////////////////////////////////////////









////USER TO DELETE THEIR ACCOUNTS///////////////////////////////////////////////////////////////////////
if(isset($_POST['deleteMe'])){
    
    $add_date= date('Y-m-d H:i:s');
    $accountExpiry= date('Y-m-d H:i:s', strtotime($add_date. ' + 60 days'));

//check if user exists on the database
$resultUserExists=mysqli_query($link, "SELECT * FROM professionalstable WHERE user='".$_SESSION['user']."' ");
if(mysqli_num_rows($resultUserExists)>0){//if the user exists, now initiate delete

    $rstDeleteUser=mysqli_query($link, "UPDATE professionalstable SET status='scheduled delete', delete_on='$accountExpiry' WHERE user='".$_SESSION['user']."' ");
    if($rstDeleteUser){
        //if deletion is success, proceed to delete
        $_SESSION['message']="The account has been scheduled to delete on $accountExpiry";
        header("location: manageaccount.php");  
    }
    else{//if something failed
        $_SESSION['err']="Oops! something went wrong.";
        header("location: manageaccount.php");  
    }//end checking if execution went thro

}
else{//if the user does not exists, error out
    $_SESSION['err']="Oops, seems like you are not yet registred!";
    header("location: manageaccount.php"); 
}//end checking user existence

}//END USER ACCOUNT DELETION//////////////////////////////////////////////////////////////////////////////





//THE UNDO ACCIOUNT DELETE BUTTON//////////////////////////////////////////////////////////////////////
if(isset($_POST['revertDelete'])){
$rstUndoAccountDelete=mysqli_query($link, "UPDATE professionalstable SET status='active', delete_on=null WHERE user='".$_SESSION['user']."' ");
if($rstUndoAccountDelete){//if recovery was success
    $_SESSION['message']="account has been recovered. Welcome back";
    header("location: manageaccount.php"); 
}
else{//if reverse failed,
    $_SESSION['err']="Oops! something went wrong.";
    header("location: manageaccount.php"); 
}//end the update part

}//END THE UNDO ACCOUINT DELETE BTN////////////////////////////////////////////////////////////////////








/////////////////////////////////////////////////////////////////////////////////////////////
//PRINT STATEMENTS FROM THE GET STATEMENTS LINK
if(isset($_GET['getMyStatements'])){
$associateUser=$_GET['getMyStatements'];

//get the user names
$getUserNames=mysqli_query($link, "SELECT field, first_name,other_names,user FROM professionalstable WHERE user='$associateUser' ");
$rowGetUser=mysqli_fetch_assoc($getUserNames);


//now that we have user data, proceed
function fetch_data()  
{  
require("assets/db/config.php");
$associateUser=$_GET['getMyStatements'];

 $output = '';   

 $sql = "SELECT * FROM paymentstable WHERE user='$associateUser'";  
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
  <h3 align="center"><img src="assets/img/favicon.png"><br>BENESOFTKE LTD</h3><br /><br /> 
PAYMENT STATEMENTS FOR HOLDER #<span>'.$rowGetUser['first_name'].' '.$rowGetUser['other_names'].'</span> <br>
FIELD OF WORK: <span>'.$rowGetUser['field'].'</span> <br>
PAYMENT DETAILS AS AT: '.date('d-M-Y H:i:s').'
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
  
  $obj_pdf->Output(''.$associateUser.'-statements-'.date("Y-m-d").'.pdf', 'I');


}//END EXPORTING excel STATEMENTS FROM GET STATEMENTS BUTTON/////////////////////////////////////////////////




?>