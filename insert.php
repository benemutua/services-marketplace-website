<?php

require_once("dboperations.php");
//insert into db

$message=mysqli_real_escape_string($link, $_POST['messageBody']);
$encoded = str_rot13($message);

$rstSendMessage= mysqli_query($link, "INSERT INTO chatbot(message_to, message_from, message_context, status)
VALUES('support', '".$_SESSION['user']."', '$encoded', 'delivered') "); 
if($rstSendMessage){
echo "success";
}
else{
    echo "err";
}//end message insertion


?>