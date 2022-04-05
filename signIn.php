<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'Sign In Page';


//user is logged out if already signed in
//user is taken to login page if already signed out
if (isset($_SESSION['loggedIn'])) {
    session_destroy();
    header("Location: index.php");
} else {
    require_once('logInController.php');
    require_once('Views/signIn.phtml');
}



