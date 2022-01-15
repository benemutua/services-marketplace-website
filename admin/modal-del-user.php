
<!-----------------------------------------------
MODAL POPUP FOR DELETE USER
------------------------------------------------>

<div class="modalcontainer hidden"><!--start the modal container-->

<div class="warningBox mb-2"><!--display the warning box-->
<h6> <i class="fa fa-warning"></i> 
This will delete user, professional and payments data associated with the account and can not be undone
</h6>
</div><!--close the warning box-->



<label for="">Type "<a href="#"> <i>delete-them</i></a>" below to confirm delete </label>

<form action="dboperations.php" method="post"><!--start form-->

<input type="hidden"  name="getUserId" value="" id="getUserId">
<div class="input-group mb-1">
<input type="text"  value="" class="form-control" id="messageDelete" placeholder="delete-them">
</div>
<button type="submit" class="btn btn-danger fa fa-check" name="deleteUserAc" id="deleteUser" disabled>delete</button>
<a href="#" id="closeModal">Close Me</a>

</form><!--close the form-->

</div><!--close the modal container-->
<div class="overlayy hidden"></div>


<script>
$(document).ready(function(){

//declare variables for quicker coding
var modal=document.querySelector('.modalcontainer');
var overlay=document.querySelector('.overlayy');
var startModal=document.querySelectorAll('.openPopupBtn');
var closeModal=document.querySelector('#closeModal');
var deleteConfirm=document.querySelector('#messageDelete');
var deleteUser=document.querySelector('#deleteUser');
var getID=document.querySelector('#getUserId');


//start modal by clicking the delete button  
for(let i=0; i<startModal.length; i++)
startModal[i].addEventListener('click',function(){
  var userId=$(this).attr("id");//give the href link value as a variable for reuse
    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
    getID.value=userId;//set that textbox value to the value of linking link
  });//end opening the modals using loop



//close the modal by clicking the close me link
closeModal.addEventListener("click", function(){
  modal.classList.add('hidden');
    overlay.classList.add('hidden');
    deleteConfirm.value="";
    getID.value="";//clear the user if box
    deleteUser.disabled=true;
});


//enable delete button if the input field has the right data
$(deleteConfirm).on('keyup change', function(){
if(deleteConfirm.value=="delete-them"){
  deleteUser.disabled=false;
}
else{
  deleteUser.disabled=true;
}
});
//end the c=enable delete button


});
</script>
<!-----------------------------------------------
CLOSE THE MODAL WINDOW
------------------------------------------------>