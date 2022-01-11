<?php
session_start();
require_once('Models/userDataSet.php');
require_once('Models/friendsDataSet.php');

$view = new stdClass();
$view->pageTitle = 'My Friends';

$friendsDataSet = new friendsDataSet();
$view -> friendsDataSet = $friendsDataSet->fetchAllFriends();

$userDataSet = new userDataSet();
$dataSet = [];
foreach ($view->friendsDataSet as $friendData){
    $friendID = $friendData -> getFriendID();

    //$view -> userDataSet = $userDataSet->fetchUserByID($friendID);

}




//if user is logged in function is performed, otherwise user taken to login screen
if (isset($_SESSION['loggedIn'])){
    var_dump($dataSet);
    require_once('Views/myFriends.phtml');
} else{
    header("Location: signIn.php");
}
