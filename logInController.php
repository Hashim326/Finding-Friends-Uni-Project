<?php


require_once('Models/Register.php');


//performs check and registers users
if (isset($_POST["regButton"])) {
    $register = new Register();
    $nameReg = $_POST["firstNameReg"];
    $surnameReg = $_POST["lastNameReg"];
    $phoneReg = $_POST["phoneNumReg"];
    $emailReg = $_POST["usernameReg"];
    $passReg = $_POST["passwordReg"];
    $passRepReg = $_POST["passwordRepReg"];

    if (!empty($nameReg) && !empty($surnameReg) && !empty($phoneReg) && !empty($emailReg) && !empty($passReg) && !empty($passRepReg)) {

        if (isset($_POST["humanReg"])) {
            if ($register->checkPassword($passReg, $passRepReg) == true) {
                if ($register->checkUserExists($emailReg) == false) {
                    $register->registerUser($nameReg, $surnameReg, $phoneReg, $emailReg, $passReg);
                    unset($_SESSION['errorReg']);
                } else {
                    $_SESSION['errorReg'] = "A user with this email already exists";
                }
            } else {
                $_SESSION['errorReg'] = "Please make sure passwords match";
            }
        } else {
            $_SESSION['errorReg'] = "Please verify that you are human";
        }
    } else {
        $_SESSION['errorReg'] = "Please ensure you have filled in all the fields ";
    }

}
//performs checks and logs user in
if (isset($_POST['loginbutton'])) {

    $emailLogIn = $_POST['usernameLogIn'];
    $passLogIn = $_POST["passwordLogIn"];

    $userDataSet = new userDataSet();
    $view->userDataSet = $userDataSet->fetchUserByEmail($emailLogIn);

    $passHashed = "";

    if (!empty($emailLogIn) && !empty($passLogIn)) {
        if (isset($_POST['humanLogIn'])) {
            if ($view->userDataSet == !null) {
                foreach ($view->userDataSet as $userData) {
                    $_SESSION['ID'] = $userData->getUserID();
                    $_SESSION['name'] = $userData->getUserFirstName();
                    $_SESSION['surname'] = $userData->getUserSurname();
                    $_SESSION['phonenumber'] = $userData->getUserPhoneNumber();
                    $_SESSION['email'] = $userData->getUserEmail();
                    $_SESSION['passwordhash'] = $userData->getUserPassword();
                    $_SESSION['lat'] = $userData->getUserLat();
                    $_SESSION['long'] = $userData->getUserLong();
                    $_SESSION['loggedIn'] = true;
                }
                if (password_verify($passLogIn, $_SESSION['passwordhash']) == true) {
                    $_SESSION['errorLogIn'] = "Log In Successful - You can leave this page";
                } else {
                    unset($_SESSION['ID']);
                    unset($_SESSION['name']);
                    unset($_SESSION['surname']);
                    unset($_SESSION['phonenumber']);
                    unset($_SESSION['email']);
                    unset($_SESSION['passwordhash']);
                    unset($_SESSION['lat']);
                    unset($_SESSION['long']);
                    unset($_SESSION['loggedIn']);
                    $_SESSION['errorLogIn'] = "No user found with those details";
                }
            } else {
                $_SESSION['errorLogIn'] = "No user found with those details";
            }
        } else {
            $_SESSION['errorLogIn'] = "Please verify that you are a human";
        }
    } else {
        $_SESSION['errorLogIn'] = "Please enter both your email and password";
    }
}