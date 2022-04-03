<?php
session_start();

//Full profile view shown if logged in
if(isset($_SESSION['loggedIn'])){


    require_once('Models/userDataSet.php');
    require_once('Models/friend.php');

    $view = new stdClass();
    $view->pageTitle = 'View Profile Page';

    $userDataSet = new userDataSet();
    $view->userDataSet = $userDataSet;

    require_once('Views/viewProfile.phtml');

}else{
    header("Location: signIn.php");
}



