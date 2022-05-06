<?php

//Triggers search function when search button is pressed
if (isset($_POST['searchButton'])) {

    $searchVal = $_POST['searchVal'];


    $view->userDataSet = $userDataSet->fetchUserByName($searchVal);


    if (!empty($searchVal)) {
        if ($view->userDataSet == !null) {
            $_SESSION['searchVal'] = $searchVal;
            unset($_SESSION['errorSearch']);
        } else {
            $_SESSION['errorSearch'] = "No user found with those details";
            unset($_SESSION['searchVal']);
        }

    } else {
        $_SESSION['errorSearch'] = "Please enter a search value";
        unset($_SESSION['searchVal']);
    }
} elseif (isset($_GET['searchVal'])){
    $_SESSION['selectedID'] = $_GET["searchVal"];
    //echo $_SESSION['selectedID'];
    //echo $_GET['searchVal'];
     header("Location: viewProfile.php");
}
