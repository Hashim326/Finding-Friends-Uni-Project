//creates xmlhttpsrequest objetc and assigns to variable
let xmlRequest = new XMLHttpRequest();

//fetches the auth token for the current page
let authToken = document.getElementById("authToken").innerHTML;
//let authToken = 20;

//refreshes location every 15 seconds
if (document.getElementById('error').innerHTML !== null) {
    //call the getLocation function every at specified interval
    window.setInterval(getLocation, 10000);
    var countdownTimer = 10;
    window.setInterval(decreaseTimer, 1000)
}

//a counter down timer indicating when the map is going to refresh
function decreaseTimer(){
    if (countdownTimer > 0) {
        document.getElementById('timer').innerHTML = "Refreshes in: " + countdownTimer;
        countdownTimer--;
    } else {
        countdownTimer = 10;
        document.getElementById('timer').innerHTML = "Refreshes in: " + countdownTimer;
        countdownTimer--;
    }
}

//retrieves user's friends location
function getLocation() {

    //calls request when a change of state is detected
    xmlRequest.onreadystatechange = function () {

        //if the request state response is done (4) and was successful (200)
        if (this.readyState === 4 && this.status === 200){
            //clears all existing markers from vector layer
            vectorLayer.getSource().clear();
            navigator.geolocation.getCurrentPosition(setCurUserMarker, geoError);

            if (this.responseText == 'Invalid auth token'){
                console.log(this.responseText);
            }else{
                //variable to hold json data
                var JSONdata;

                //parses received json data into variable
                JSONdata = JSON.parse(this.responseText);
                //console.log(JSONdata);
                //for each user in the data, assign their info to variables
                JSONdata.forEach(function (obj){
                        const lat = obj.uLat;
                        const long = obj.uLong;
                        const firstName = obj.firstName;
                        const surname = obj.surname;
                        //console.log(long + "----------------- long");
                        //creates markers using user info
                        createMarkerCoord(lat, long, firstName, surname)
                    }
                )
            }
        }

    }

    //if the system has already been intialised, only refresh current location pin, not the whole view.
    if (counter == 1){
        navigator.geolocation.getCurrentPosition(getCoords);
    }


}

//return coordinates of user's position
function getCoords(pos) {
   var crd = pos.coords;
   var lat = crd.latitude;
   var long = crd.longitude;
   //console.log(l  at);
   //console.log(long);
   //console.log("@@@@@@@@@@@@@@");
   sendXMLRequest(lat, long);
}

//calls ajax php to retrieve friend locations and updates user's last location.
function sendXMLRequest(lat, long){
    xmlRequest.open('GET', 'AJAX/getFriendLoc.php?long=' + lat + "&lat=" + long + "&authToken=" + authToken, true);
    xmlRequest.send();
}