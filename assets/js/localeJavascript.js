
  //define the variables to be used for quicker retrievals
  var localeChooser=document.getElementById("localeOptionChooser");
  var getMyLocation=document.getElementById("myPinLocation");
  var googleLocation=document.getElementById("googleSuggestLocation");
  var myLatitudeGoogle=document.getElementById("latInfo");
  var myLongitudeGoogle=document.getElementById("longInfo");

$(localeChooser).on("change", function(){//when the select option changes, adjust the inputs

//START THE MAP SCRIPT

function locate(){
navigator.geolocation.getCurrentPosition(initMap, fail);
}

function fail(){//if user doesnt allow access to location,
alert("Maps won't function when location access is denied!");
}
function initMap(position){
lat = position.coords.latitude;
long =position.coords.longitude;
var myLat=document.getElementById("latInfo");//these variables will be used below to set the input value
var myLong=document.getElementById("longInfo");//these variables will be used below to set the input value

//now fill the latitude and longituide inputs with data from map
myLat.value=lat;
myLong.value=long;
}
//END THE MAP SCRIPT

//now handle what happens when the select location option changes.
if(localeChooser.value=="my current location"){
//clxear the latitude and longitude fields
myLatitudeGoogle.value="";
myLongitudeGoogle.value="";
locate();//run the function for geting the google latitude and longitude
//then open the input field
  getMyLocation.classList.remove("hidden");
  googleLocation.classList.add("hidden");
  googleLocation.value="";//make the input of the other hiding input null
}
else if(localeChooser.value=="type business location"){
 //clear the latitude and longitude fields
 myLatitudeGoogle.value="";
myLongitudeGoogle.value="";
//then open the input field
googleLocation.classList.remove("hidden");
getMyLocation.classList.add("hidden");
getMyLocation.value="";//make the input of the other hiding input null
}

else{//by default hide the input fields
  getMyLocation.classList.add("hidden");
  googleLocation.classList.add("hidden");
  //clear the latitude and longitude fields
  myLatitudeGoogle.value="";
  myLongitudeGoogle.value="";
}

});