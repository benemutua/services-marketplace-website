<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
<hr>  








<div class="chatArea" id="chatThreads"><!--start chat reply part-->
<h5 style="text-align:center; color: red;">Chat Thread</h5>


<!---------------------------------------------------------------------------------------
the scrollable messages encloser--------------------------------------------------------->
<div class="messageArea">
<?php 
//notes and logics
//1. if message originates from support, you can not reply to it
//2. you can reply to m,essages originating from client side
//3. Messages will be deleted automatically after 3 weeks
//4. messages originating from support uses status 'SENT' which does not change
//5. messages from user can change from #DELIVERED-READ-REPLIED
//6. when you click to read a message from user, it will change status to read but from support it wont
//7. this page SHOWS ALL messages 


$rstGetMessages=mysqli_query($link, "SELECT * FROM chatbot WHERE message_from='$messageSender' AND message_to='support' OR message_to='$messageSender' AND message_from='support' 
OR message_from='support' AND message_to='$messageReceiver' OR message_from='$messageReceiver' AND message_to='support' "); 
//if they have ever had a conversation witrh support, display
if(mysqli_num_rows($rstGetMessages)>0): ?>
<?php while($rowMessages=mysqli_fetch_assoc($rstGetMessages)): ?>
<!--echo out the messages-->


<?php if($rowMessages['message_from']=='support'): ?>
  <p class="from-me"><!--show message from support-->
<?php echo str_rot13($rowMessages['message_context']); ?>
</p><!--show message from support-->


<?php else: ?>
  <p class="from-them"><!--show message from self-->
<?php echo str_rot13($rowMessages['message_context']); ?>
</p><!--show message from self-->
<?php endif; ?>
<?php endwhile; ?>

<?php else: ?>
<p>Open a chat to view thread</p>
<!--start script for hifing the div since no message has been clicked to avoid space wastage-->
<script>
  $(document).ready(function(){
    var chats=document.getElementById("chatThreads");

    chats.hidden=true;
  });
 </script><!--end the script for hidig the div-->
<?php endif; ?>
</div><!----------------------------------------------------------------------
end the scrollable message encloser------------------------------------------>





<div class="theInput"><!--start the chat reply part-->
<form action="dboperations.php" method="post">

  <input type="text" name="messageID" value="<?php echo $messageID; ?>" required class="hidden">
  <input type="text" name="replyTo" id="replyTO" value="<?php echo $messageSender; ?>" required class="hidden">
<div class="input-group"><!--start the input area-->
<textarea name="messageBody" id="messageBody" value="" rows="1" required placeholder="Type your message here.." class="form-control form_data"></textarea>
<button type="submit" name="submit" id="sendMsgBtn" disabled class="btn btn-success ri-send-plane-2-line"></button>
</div><!--end input area-->

</form>
</div><!--end the chat reply part-->
</div><!--end the reply part-->











<!---------------------------------------------------------------------------------
THE BELOW TABLE SHOWS ALL MESSAGES
----------------------------------------------------------------------------------->
<h5>All Messages</h5>

<div class="tablesSliderDiv mt-10"><!---start the tables slider div makes the tables responsive-->
<!------------------------this div refreshes every 3 seconds------>
<div id="loadmessages">
<!--start of the table -->
<table class="table table-striped">
<tr>
  <th>No.</th>
<th>From</th>
<th>To</th>
<th>Message Body</th>
<th>Status</th>
<th>Date/time</th>
<th>action</th>
</tr>

<?php $getMessages=mysqli_query($link, "SELECT * FROM chatbot ORDER BY message_id DESC");
if(mysqli_num_rows($getMessages)): ?>
<?php while($row=mysqli_fetch_assoc($getMessages)):?>
<tr>
<td><span class="badge bg-info"><?php echo $row['message_id']; ?> </span> </td>
<td><?php echo $row['message_from']; ?></td>
<td><?php echo $row['message_to']; ?></td>
<td><?php echo str_rot13($row['message_context']); ?></td><!--this message has been decrypted now-->

<!--show didff displays for read/replied messages and unread-->
<?php if($row['status']=='read'): ?>
<td><span class="badge bg-secondary"><?php echo $row['status']; ?></span> </td>
<?php elseif($row['status']=='replied' || $row['status']=='sent'): ?>
<td><span class="badge bg-info"><?php echo $row['status']; ?></span> </td>
<?php else: ?>
<td><span class="badge bg-primary"><?php echo $row['status']; ?></span> </td>  
<?php endif; ?>
<!--end the logics for message status-->

<td><?php echo $row['sent_date']; ?></td>

<!--if message is from support, just allow read only else show read/ply-->
<?php if($row['message_from']=='support'): ?>
<td>
<a href="messages.php?seeMessage=<?php echo $row['message_id']; ?>" class="readTheMessage badge bg-primary"><i class="fa fa-eye">Read</i> </a></td>  
</td>
<?php else: ?>
<td>
<a href="messages.php?seeMessage=<?php echo $row['message_id']; ?>" class="readTheMessage badge bg-success"><i class="fa fa-eye">Read/ply</i> </a></td>  
</td>
<?php endif; ?>
<!--end the button logics-->


</tr>
<?php endwhile; ?>
<?php else: ?>
<tr> <td colspan="7"> No Messages found </td> </tr>
<?php endif; ?>

</table>

</div><!---clos ethe auto refreshing div window for messages--->
</div><!--end the responsive slider div for tables-->



<script>
var auto_refresh = setInterval( function() {
  $("#loadmessages").load(location.href + " #loadmessages");  
    }, 3000); 

</script>





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
  <script src="js/mycustomjsfile.js"></script>
