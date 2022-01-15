
<!-----------------------------------------------
MODAL POPUP FOR VERIFICATION
------------------------------------------------>

<div class="modalcontainer hidden"><!--start the modal container-->

<span>&times;</span><!--the top -right close x button-->


<!--------------------------------------------------------
this div show custom message----------------------------->
<div class="customMessage">
<p class="mb-1 customlabel">
Only the fields listed below can be edited for security reasons. Else, contact support on 
<a href="mailto: support@serviceskenya.co.ke"> Support@serviceskenya.co.ke</a></p>
</div>
<!-----------------------end the custom message div----->


<form action="dboperations.php" method="post"><!-----start the form--->
<!------------------------------------------------
START THE MODAL PARENT DIV------------------------>
<div class="modalParentDiv">

<div class="modalInnerDiv"><!---------start the modal inner div 1------->

<label for="">Phone & Email</label>
<div class="input-group">
<input type="text" name="mobileNumber" value="<?php echo $rowUserInfo['mobile_number']; ?>" maxlength="10" placeholder="Phone number 07xx"  class="form-control">
<input type="email" name="emailAddress" value="<?php echo $_SESSION['email']; ?>" placeholder="Email address"  class="form-control">
</div>



<label for="">Are you Mobile?</label>
<div class="input-group mb-1">
<select name="mobility" class="form-control">
<option value="">-select-</option>
<option value="Mobile to work" <?php if($rowUserInfo['mobility']=="Mobile to work") echo 'selected="selected"'; ?>>Yes</option>
<option value="Not Mobile" <?php if($rowUserInfo['mobility']=="Not Mobile") echo 'selected="selected"'; ?>>No</option>
</select>
</div>


<label for="">Edit When you Operate?</label>
<div class="input-group mb-1">
<select name="accesibility" class="form-control">
<option value="">-select-</option>
<option value="During Day Time" <?php if($rowUserInfo['accesibility']=="During Day Time") echo 'selected="selected"'; ?>>Daytime</option>
<option value="At Night" <?php if($rowUserInfo['accesibility']=="At Night") echo 'selected="selected"'; ?>>Night</option>
<option value="24/7"  <?php if($rowUserInfo['accesibility']=="24/7") echo 'selected="selected"'; ?>>24/7</option>
</select>
</div>



<label for="" class="customlabel">My Field</label>
<div class="input-group mb-1">
<input type="text" name="myField" value="<?php echo $rowUserInfo['field']; ?>" class="form-control inactive" placeholder="specialized in?">
</div>

<label for="">Edit Speciality?</label>
<div class="input-group mb-1">
   <input type="text" name="speciality" value="<?php echo $rowUserInfo['speciality']; ?>" class="form-control" placeholder="specialized in?">
</div>
<label class="customlabel fa fa-arrow-up" for="">
    Separate with '|' if many LIKE:  Audit|Tax|Book Keeping
  </label>

</div><!-----end modal inner div 1----------->



<div class="modalInnerDiv"><!---------start the modal inner div 2------->

  <label for="">Professional Body(optional)</label>
<div class="input-group mb-1">
   <input type="text" name="associations" value="<?php echo $rowUserInfo['associations']; ?>" class="form-control" placeholder="eg LSK">
</div>
  

  <label for="">Website/LinkedIn profile(optional)</label>
<div class="input-group mb-1">
   <input type="text" name="myUrl" value="<?php echo $rowUserInfo['external_link']; ?>" class="form-control" placeholder="www.mywebsite.com">
</div>


<label for="">Edit What you do:</label>
<div class="input-group mb-1">
  <textarea name="about" value="" placeholder="Describe your profession" maxlength="500" class="form-control"  rows="4"><?php echo $rowUserInfo['about']; ?></textarea>
</div>

<label for="" id="editConfirmDialog">Type "<a href="#"> <i>yes-edit</i></a>" below to confirm edit </label>
<div class="input-group mb-1">
<input type="text"  value="" class="form-control" id="confirmEdit" placeholder="yes-edit">
</div>


<button type="submit" class="btn btn-primary fa fa-check" name="updateRecordsBtn" id="updateRecordsBtn" disabled>Update</button>

</div><!-----end modal inner div 2----------->

</div><!------------------------------------------
END THE MODAL PARENT DIV------------------------->
</form><!---end the form-->

</div><!--close the modal container-->
<div class="overlayy hidden"></div>


<script>
//declare variables for quicker coding
var modal=document.querySelector('.modalcontainer');
var overlay=document.querySelector('.overlayy');
var closeModal=document.querySelector('.modalcontainer span');
var startModal=document.querySelector('#btnEditAccount');
var editConfirm=document.querySelector('#confirmEdit');
var updateRecords=document.querySelector('#updateRecordsBtn');



//when the input for confirm edit is set to 'yes-edit'
$(editConfirm).on('keyup change', function(){
if(editConfirm.value=="yes-edit"){
    updateRecords.disabled=false;
}
else{
    updateRecords.disabled=true;
}
});
//end confirming update



//start modal by clicking the edit button
startModal.addEventListener('click',function(){
    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
});

//close modal By clicking the close on the right top
closeModal.addEventListener('click',function(){
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
    editConfirm.value='';
});

//close modal by clicking outise it
overlay.addEventListener('click',function(){
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
    editConfirm.value='';
});


</script>
<!-----------------------------------------------
CLOSE THE MODAL WINDOW
------------------------------------------------>