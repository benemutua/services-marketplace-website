<?php require_once('header.php'); ?>   

<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height"> <!--now start the wrapper section-->         
 


<!--strat the payment parent container---->
<div class="payReportParent mt-5">
<h5>Reports Portal</h5>

<!--display the tab container------------->
<div class="warningBox mt-2 mb-3">
  After selecting the type of report needed, it will popup a console for performing further executions. 
  Each report console is different
</div>
<!--end the notification container-->


<select id="selectReport" class="form-control">
<option value="">-choose type-</option>
<option value="general report">General Report</option>
<option value="individual report">Individual Report</option>
</select>

</div>
<!--end the payments parent container-->


<!-----------------------------------------------------------------------------
start the general report div
------------------------------------------------------------------------------>
<div class="payReportGeneral hidden">

<form action="dboperations.php" method="post"><!--start the form-->
<label for="">For period between</label>
<div class="input-group mb-2">
  <input type="date" name="startDate" value="" class="form-control">
  <input type="date" name="endDate" value="" class="form-control">
</div>

<label for="">Account select</label>
<select name="accountType" class="form-control mb-2">
  <option value="">-select account-</option>
  <option value="boosting">Boosting accounts</option>
  <option value="registrations">Registrations A/cs</option>
</select>

<button type="submit" name="excelGeneralReport" class="btn btn-success fa fa-file-excel-o">Print excel</button>
<button type="submit" name="pdfGeneralReport" class="btn btn-secondary fa fa-file-pdf-o">Print Pdf</button>
</form><!--end the form-->
</div>
<!---------------------------------------------------------------------
end the general report div
---------------------------------------------------------------------->




<!----------------------------------------------------------------------------------------
start individual report div-
----------------------------------------------------------------------------------------->
<div class="payReportIndividual hidden">

<form action="dboperations.php" method="post"><!--start the form-->
<label for="">For period between</label>
<div class="input-group mb-2">
  <input type="date" name="startDate" value="" class="form-control">
  <input type="date" name="endDate" value="" class="form-control">
</div>

<label for="">Account Specification</label>
<div class="input-group mb-2">
<input type="text" name="userHolder" value="" class="form-control" placeholder="Account Username here.." required>

<select name="accountType" required class="form-control">
  <option value="">-select-</option>
  <option value="boosting">Boosting accounts</option>
  <option value="registrations">Registrations A/cs</option>
</select>
</div>
<button type="submit" name="excelIndividualReport" class="btn btn-success fa fa-file-excel-o">Print Excel</button>
<button type="submit" name="pdfIndividualReport" class="btn btn-danger fa fa-file-pdf-o">Print Pdf</button>
<button type="button" id="sendMail" class="btn btn-secondary fa fa-sign-out">Email & Attach</button>


<div class="mailDiv mt-1 hidden"><!--start hidden div for mail-->
<label for="">Enter the client email</label>
<div class="input-group">
<input type="email" name="emailAddress" value="" placeholder="client email address" class="form-control">
<button type="submit" name="emailClient" class="btn btn-primary ri-send-plane-2-line"></button>
</div>
</div><!--end the hidden div for mail-->

</form><!--close the individual form-->
</div>
<!--------------------------------------------------------------------------------------
end individual report div-
--------------------------------------------------------------------------------------->






<!--------------------------------------------------------------------
THIS SCRIPT SETS DIV TO HIDDEN OR SHOWING BASED ON SELECTIONS
---------------------------------------------------------------------->
<script>
  $(document).ready(function(){
var generalReport=document.querySelector(".payReportGeneral");
var individualReport=document.querySelector(".payReportIndividual");
var selectReport=document.querySelector("#selectReport");
var mailBtn=document.getElementById("sendMail");
var mailInput=document.querySelector(".mailDiv");

$(selectReport).on("change", function(){//start the report type selecetion
if(selectReport.value=="general report"){//show general div and hide individual one
  generalReport.classList.remove("hidden");
  individualReport.classList.add("hidden");
}
else if(selectReport.value=="individual report"){//show the individual div and hide the general div
  individualReport.classList.remove("hidden");
  generalReport.classList.add("hidden");
}
else{
  individualReport.classList.add("hidden");
  generalReport.classList.add("hidden");
}
});//end the select report type selection

mailBtn.addEventListener("click", function(){
  mailInput.classList.remove("hidden");
});

  });
</script>
<!---------------------------------------------------------------------
END THE SHOW/HIDE DIV SCRIPT
---------------------------------------------------------------------->









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
