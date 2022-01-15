<!-----------------------------------------------------------------------------------------------------
start the chatting window--
------------------------------------------------------------------------------------------------------>
<?php if(isset($_SESSION['loggedin'])): ?>
<div class="messageBox hidden"></div>


<div class="chatArea hidden"><!--start the charting area-->
<span class="fa fa-times-circle-o"> </span> 
<div class="messageArea"><!--start message area div-->
<div id="refreshmessages"><!---------THE auto refreshing div STARTS HERE------------------->
<?php 
$rstGetMessages=mysqli_query($link, "SELECT * FROM chatbot WHERE message_from='".$_SESSION['user']."' OR message_to='".$_SESSION['user']."' ORDER BY message_id ASC"); 
//if they have ever had a conversation witrh support, display
if(mysqli_num_rows($rstGetMessages)>0): ?>
<?php while($rowMessages=mysqli_fetch_assoc($rstGetMessages)): ?>
<!--echo out the messages-->


<?php if($rowMessages['message_from']=='support'): ?>
  <p class="from-them"><!--show message from support-->
<?php //decode the messafe then display
echo str_rot13($rowMessages['message_context']);
?>
</p><!--show message from support-->



<?php else: ?>
<p class="from-me"><!--show message from self-->
<?php //decode the message then show
echo str_rot13($rowMessages['message_context']);
?>
</p><!--show message from self-->
<?php endif; ?>

<?php endwhile; ?>
<?php else: //if no conmversation found, ?>
  <p class="from-them"><!--show message from support-->
Need assistance? Our support is online to help
</p><!--show message from support-->
<?php endif; ?>
</div><!---NOW END THE AUTO REFRESHING DIV----------------------->

<!-------------------------------------------------------------------------------------
JAVASCRIPT CODE FOR AUTO REFRESH AND MESSAGE CONTAINER IS ON SEND MSG .JS
-------------------------------------------------------------------------------------->
</div><!--end the message area div-->

<div class="theInput"><!--start the chat reply part-->
<form action="insert.php" method="post" id="frmBox"onsubmit="return formSubmit();">
<div class="input-group"><!--start the input area-->
<textarea name="messageBody" id="messageBody" value="" rows="1" required placeholder="Type your message here.." class="form-control"></textarea>
<button type="submit" name="submit" id="sendMessage" disabled class="btn btn-success ri-send-plane-2-line"></button>
</div><!--end input area-->
</form>
</div><!--end the chat reply part-->
</div><!--end the chatting area-->
<!--end chatting window-->


<!--ajax script to submit form automatically-->
<script type="text/javascript">
function formSubmit(){
$.ajax({
type: "POST",
url: "insert.php",
data:$("#frmBox").serialize(),
success: function(response){
  $("#success").html(response);
setTimeout(function(){
  $("#success").hidden=true;
},2000);

}
});
var form=document.getElementById("frmBox").reset();
return false;
}

</script>
<!--end the ajax submit script-->

<?php else: ?>
<?php endif; ?>
<!--------------------------------------------------------------------------------------------------
ALL THIS IS FOR CHAT AID
--------------------------------------------------------------------------------------------------->