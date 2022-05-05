//refreshes location every 15 seconds
if (document.getElementById('error').innerHTML !== null) {
    //call the getLocation every 15000ns
    window.setInterval(getLocation, 15000);
    var countdownTimer = 15;
    window.setInterval(decreaseTimer, 1000)
}

//a counter down timer indicating when the map is refresh
function decreaseTimer(){
    if (countdownTimer > 0) {
        document.getElementById('timer').innerHTML = "Refreshes in: " + countdownTimer;
        countdownTimer--;
    } else {
        countdownTimer = 15;
        document.getElementById('timer').innerHTML = "Refreshes in: " + countdownTimer;
        countdownTimer--;
    }
}


let xmlRequest = new XMLHttpRequest();

//retrieves user's friends location
function getLocation() {


    xmlRequest.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200){
            vectorLayer.getSource().clear();
            navigator.geolocation.getCurrentPosition(setCurUserMarker, geoError);

            var JSONdata;
            //console.log('Hello');
            JSONdata = JSON.parse(this.responseText);
            //console.log(JSONdata);
            JSONdata.forEach(function (obj){
                    const lat = obj.uLat;
                    const long = obj.uLong;
                    const firstName = obj.firstName;
                    const surname = obj.surname;
                    //console.log(long + "----------------- long");
                    createMarkerCoord(lat, long, firstName, surname)
                }
            )
        }

    }

    if (counter == 1){
        navigator.geolocation.getCurrentPosition(getCoords);
    }


}

//return coordinates of user's position
function getCoords(pos) {
   var crd = pos.coords;
   var lat = crd.latitude;
   var long = crd.longitude;
   //console.log(lat);
   //console.log(long);
   //console.log("@@@@@@@@@@@@@@");
   sendXMLRequest(lat, long);
}

//calls ajax php to retrieve friend locations and updates user's last location.
function sendXMLRequest(lat, long){
    xmlRequest.open('GET', 'AJAX/getFriendLoc.php?long=' + lat + "&lat=" + long, true);
    xmlRequest.send();
}