//creates xmlhttprequest object and assigns to variable
let xmlRequest = new XMLHttpRequest();

//fetches the auth token for the current page
let authToken = document.getElementById("authToken").innerHTML;
let authToken = 20;

function performSearch(input) {
    console.log(input);
    if (input == "") {

        //console.log("null detected")
        //clears the results box, if no search value
        document.getElementById("liveResults").innerHTML = "";
        document.getElementById("liveResults").style.border = "none";
    } else {
        //console.log("check pass")

        //calls request when a change of state is detected
        xmlRequest.onreadystatechange = function () {

            //if the request state response is done (4) and was successful (200)---(previous request is finished)
            if (this.readyState === 4 && this.status === 200) {

                //variable to hold json data
                var JSONdata;
                document.getElementById("liveResults").innerHTML = "";

                if (this.responseText == 'Invalid auth token'){
                    console.log(this.responseText);
                }else{
                    //parses received json data into variable
                    JSONdata = JSON.parse(this.responseText);
                    //console.log(JSONdata);

                    //if data has been retrieved, then it is output
                    if (JSONdata !== null){

                        //creates edge of results box
                        document.getElementById("liveResults").style.border = "thin solid #000000";

                        //for each user in the data, assign their info to variables
                        JSONdata.forEach(function (obj) {
                            const userID = obj.userID;
                            console.log(userID);
                            const firstName = obj.firstName;
                            const surname = obj.surname;

                            //adds user to the results list
                            addUser(firstName, surname, userID)

                        })

                    }
                }


            }
        }
        //calls the php file to return search results as JSON using search value
        xmlRequest.open('GET', 'AJAX/liveSearch.php?searchVal=' + input + "&authToken=" + authToken, true);
        xmlRequest.send();
    }
}


//adds each user to the results column and links it to their page
function addUser(firstName, surname, userID) {
    let aLink = '<li class="list-group-item"><a href="search.php?searchVal='+ userID +'">'+ firstName + ' ' + surname + '</a></li>';
    console.log(aLink);
    document.getElementById('liveResults').innerHTML += aLink;


}