//checks if both passwords match and produces error message if needed
function validatePassword(){
    let pass1 = document.forms["reg"]["passwordReg"].value;
    let pass2 = document.forms["reg"]["passwordRepReg"].value;

    if (pass1 !== pass2){
        document.getElementById("passRepRegDiv").innerHTML
        = '<p class="text-danger col-sm-6">Passwords do not match</p>';
        return false;
    }
    else {
        document.getElementById("passRepRegDiv").innerHTML = "";
        return true;
    }
}

//checks if email is valid
function validateEmail(){
    let email = document.forms["reg"]["usernameReg"].value;

    //a regular expression to specify the formation of a valid email
    let regex = new RegExp('[._a-zA-Z0-9\-]+@[a-zA-Z]+[.]+[a-zA-Z]');

    //checks if input matches required format
    if (regex.test(email) === false){
        document.getElementById("emailDiv").innerHTML
            = '<p class="text-danger col-sm-6">Invalid email</p>';
        return false;
    }else{
        document.getElementById("emailDiv").innerHTML = "";
        return true;
    }
}

//a function to check if the user has only entered numbers into the phone number
function validatePhoneNum(){
    let phoneNum = document.forms["reg"]["phoneNumReg"].value;

    //a regular expression to specify the formation of a valid phone number
    let regex = new RegExp('[0-9]')

    //checks if input is numeric
    if (regex.test(phoneNum)===false){
        document.getElementById("phoneDiv").innerHTML
            = '<p class="text-danger col-sm-6">Invalid phone number</p>';
        return false;
    }else{
        document.getElementById("phoneDiv").innerHTML = "";
        return true;
    }
}

//a function to check if the user has only entered letters for their first name
function validateFname(){
    let fName = document.forms["reg"]["firstNameReg"].value;

    //check is the name is made up of letters
    let regex = new RegExp('[A-Za-z]')

    //checks if input is valid
    if (regex.test(fName)===false){
        document.getElementById("firstNameDiv").innerHTML
            = '<p class="text-danger col-sm-6">Invalid name</p>';
        return false;
    }else{
        document.getElementById("firstNameDiv").innerHTML = "";
        return true;
    }
}

//a function to check if the user has only entered letters for their last name
function validateLname(){
    let lName = document.forms["reg"]["lastNameReg"].value;

    //check is the name is made up of letters
    let regex = new RegExp('[A-Za-z]')

    //checks if input is valid
    if (regex.test(lName)===false){
        document.getElementById("lastNameDiv").innerHTML
            = '<p class="text-danger col-sm-6">Invalid name</p>';
        return false;
    }else{
        document.getElementById("lastNameDiv").innerHTML = "";
        return true;
    }
}

function validateForm() {
    if (validatePassword() === true
        && validateEmail() === true
        && validatePhoneNum() === true
        && validateFname() === true
        && validateLname() === true){

        console.log("true")
        document.forms["reg"].submit();
    } else{

        console.log("false")
        //return false;
    }
}