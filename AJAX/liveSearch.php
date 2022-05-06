<?php
session_start();
require_once('../Models/userDataSet.php');

$searchVal = $_GET['searchVal'];
$userDataSet = new userDataSet();

$sessionAuth = $_SESSION["authToken"];
$receivedAuth = $_GET["authToken"];

//checks if provided session code matches, else returns error
if ($receivedAuth == $sessionAuth){
    if ($searchVal == ""){
        echo json_encode($userDataSet);
    }else{
        echo json_encode($userDataSet->fetchUserByNameLimit($searchVal));
    }
}else{
    echo 'Invalid auth token';
}



