<?php
session_start();

//if user is logged in function is performed, otherwise user taken to login screen

if (isset($_SESSION['loggedIn'])) {

    $_SESSION['selectedID'] = $_SESSION['ID'];
    require_once('Models/userDataSet.php');
    require_once('Models/friend.php');

    $view = new stdClass();
    $view->pageTitle = 'View Profile Page';

    $userDataSet = new userDataSet();
    $view->userDataSet = $userDataSet;

    require_once('Views/viewProfile.phtml');

} else {
    header("Location: signIn.php");
}



