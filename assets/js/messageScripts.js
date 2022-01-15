//START THE AUTO REFRESHING DIV SCRIPT
var auto_refresh = setInterval( function() {
    $("#refreshmessages").load(location.href + " #refreshmessages");  
      }, 3000); 
  //END THE AUTO REFRESHING DIV SCRIPT



  //SHOW OR HIDE THE CONTACTS INFO DIV WHEN THE BUTTON IS CLICKED
  
    var specialOpenBtn=document.querySelectorAll(".mySpecialBtn");
    var contactsInfo=document.querySelectorAll(".theContactInfo");
    
    for(let i=0; i<specialOpenBtn.length; i++)
    specialOpenBtn[i].addEventListener("click", function(){
        $(contactsInfo).show(); 
        alert("Contact information will now display automatically");
        $(specialOpenBtn).hide();
    });//end the opening btn
  
    //END THE MYSPECIAL BTN FUNCTIONALITY for opening contacts show
  



  
//THE SEND MESSAGE WINDOW

//var audio = new Audio('assets/audio/beep-06.mp3');
var chatbox=document.querySelector(".messageBox");
var messageP=document.querySelector(".messageBox p");
var chatArea=document.querySelector(".chatArea");
var closeChat=document.querySelector(".chatArea span");
var messageBody=document.querySelector("#messageBody");
var sendMessage=document.querySelector("#sendMessage");


  //start the chat box after some seconds
setTimeout(function(){ 
  //audio.play(); 
  $(chatbox).slideDown("slow").removeClass("hidden");
  messageBody.value="";
  }, 3000); 

//open chat area after clicking the message box
chatbox.addEventListener("click", function(){
$(chatArea).slideDown("slow").removeClass("hidden");
});

//close the chat area by closing the close span
closeChat.addEventListener("click", function(){
  $(chatArea).slideDown("slow").hide();
messageBody.value="";
});



//disable the send button untill the text area is popyulated with data

$(messageBody).on("keyup change", function(){
  if(messageBody.value.length>0){
  sendMessage.disabled=false;
  }
  else{
  sendMessage.disabled=true; 
  }
  
  });//end disabling the send button based on inpoyut field

//END THE SEND MESSAGE WINDOW