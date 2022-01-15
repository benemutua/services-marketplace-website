//////////
//preview image before upload

function previewImage(event){
var reader = new FileReader();
reader.onload = function()
{
var output = document.getElementById('profileImage');
output.src = reader.result;
}
reader.readAsDataURL(event.target.files[0]);
}









//SCRIPT FOR THE ACCOUNT DELETION WIZARD ON THE MANAGE ACCOUNT PAGE

var deleteBtn =document.querySelector("#deleteAccount");
var deleteDiv =document.querySelector(".hiddenDeleteDiv");
var deleteMyData=document.querySelector("#deleteMyData");
var finalyDelete=document.querySelector("#finalyDelete");
var closeWindow=document.querySelector("#closeWindow");
var deleteMessage="Your account will be scheduled to delete after 60 days. You can recover your account before the period elapses";


//make the hidden delete div appear on delete button click
deleteBtn.addEventListener('click', function(){
deleteDiv.classList.remove("hidden");
});

//hide the delete div on link click & clear the input
closeWindow.addEventListener('click', function(){
  deleteMyData.value='';
  deleteDiv.classList.add("hidden");
});


//deny delete button click if the delete me field has no data
$(deleteMyData).on("keyup change", function(){
if(deleteMyData.value=='delete-me'){
//now enable the delete button to perform deletion
finalyDelete.disabled=false;
}
else{//if the value is not delete-me
  finalyDelete.disabled=true;
}
});//end the delete option

//show alert when someone tries delete accouint
finalyDelete.addEventListener('click', function(){
alert(deleteMessage);
});//end account undo

//end the account deletion script





//SCRIPT FOR THE MAKE PAYMENT ON THE MANAGE ACCOUNT PAGE

  //define variables
  var makePayment=document.querySelector("#makePaymentsBtn");
  var paymentDiv=document.querySelector(".paymentsDiv");
  var closePaymentDiv=document.querySelector("#closePaymentsDiv");
  var payableAmount=document.querySelector("#payableAmount");
  var subGateway=document.querySelector("#subscriptionGateway");
  var myPaymentSubscription=document.querySelector("#myPaymentSubscription");

  //now unhide the payments div when the make payments button is clicked
  makePayment.addEventListener("click", function(){
    paymentDiv.classList.remove("hidden");
  });//end opening the payments div

  //now hide the payments div when the close me button is clicked 
  closePaymentDiv.addEventListener("click", function(){
  paymentDiv.classList.add("hidden");
  });//end opening the payments div



  //make the selected option show value on the textbox and enable the submit button
  $(subGateway).on("change", function(){
   if(subGateway.value=='2 months'){
    payableAmount.value=1500;
    myPaymentSubscription.disabled=false;
   }//if selection is 2 months

   else if(subGateway.value=='4 months'){
    payableAmount.value=3000;
    myPaymentSubscription.disabled=false;
   }//if selection is 4 months

   else if(subGateway.value=='6 months'){
    payableAmount.value=5000;
    myPaymentSubscription.disabled=false;
   }//if selection is 6 months

   else if(subGateway.value=='12 months'){
    payableAmount.value=9000;
    myPaymentSubscription.disabled=false;
   }//if selection is 12 months

   else{//if no selection is made,
    payableAmount.value='';
    myPaymentSubscription.disabled=true;
   }//end the automatic feed

  });//end the auto complete form


// END THE CUSTOM MAKE PAYMENT SCRIPT ON MANAGEACCOUNT PAGE



