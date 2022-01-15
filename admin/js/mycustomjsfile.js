//SCRIPT FOR THE MAKE PAYMENT ON THE MANAGE ACCOUNT PAGE
$(document).ready(function(){
  //define variables
  var makePayment=document.querySelector("#makePaymentsBtn");
  var paymentDiv=document.querySelector(".paymentsDiv");
  var closePaymentDiv=document.querySelector("#closePaymentsDiv");
  var payableAmount=document.querySelector("#payableAmount");
  var subGateway=document.querySelector("#subscriptionGateway");
  var myPaymentSubscription=document.querySelector("#myPaymentSubscription");


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

});// END THE CUSTOM MAKE PAYMENT SCRIPT ON MANAGEACCOUNT PAGE



//UPDATE MY DATA ON USER INFO PAGE
$(document).ready(function(){
var updateText=document.getElementById("updateMyData");
var updateBtn= document.getElementById("updateBtn");

$(updateText).on("keyup change", function(){

  if(updateText.value=="yes-update"){
    updateBtn.disabled=false;
  }
  else{
    updateBtn.disabled=true;
  }

});

});//END UPDATE DATA ON USER INFO PAGE



//JAVASCRIPT FOR PROFESSIONAL VIEW
$(document).ready(function(){
var updateUserData=document.querySelector("#updateDataRecords");
var enableUseredit=document.querySelector("#enableeditInfo");

$(enableUseredit).on("keyup change", function(){
  if(enableUseredit.value=='edit-data'){
    updateUserData.disabled=false;
  }
  else{
    updateUserData.disabled=true;
  }//end checking entry value
  
});

});//END THE VIEW PROFESIONAL EDIT

//DISANBLE THE MESSAGE SEND BUTTON IF THE REPLYTO CVALUE IS SUPPORT

$(document).ready(function(){
  var reply=document.getElementById("replyTO");
  var sendMsgBtn=document.getElementById("sendMsgBtn");
  
  //if the reply to is support, disable submit btn
  if(reply.value=='support'){
    sendMsgBtn.disabled=true;
    sendMsgBtn.addEventListener("click",function(){
alert("you can not reply to your own message");
    });
  }
  else{
    sendMsgBtn.disabled=false;
  }
  });
  //END THE MESSAGE SENT LIMITATION

