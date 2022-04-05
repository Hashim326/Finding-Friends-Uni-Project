<?php
session_start();
//phpinfo();
require_once('Models/userDataSet.php');
require_once('Models/friendsDataSet.php');
require_once('Models/friend.php');
require_once('buttonController.php');

$view = new stdClass();
$view->pageTitle = 'My Friends';

$friendsDataSet = new friendsDataSet();
$view->friendsDataSet = $friendsDataSet->fetchAllFriends();
//var_dump($friendsDataSet);
$userDataSet = new userDataSet();
$view->userDataSet = $userDataSet;
//$dataSet = [];
$friendIDArr = [];

if ($view->friendsDataSet != null) {
    foreach ($view->friendsDataSet as $friendData) {

        //var_dump($friendData);
        $friendID = $friendData->getFriendID();

        //var_dump($friendID);
        array_push($friendIDArr, $friendID);


    }
    $view->userDataSet = $userDataSet->fetchUserByID($friendIDArr);
    foreach ($view->userDataSet as $userData) {
        //var_dump($userData);
    }
    $_SESSION['friendError'] = "";
} else {
    $_SESSION['friendError'] = "You currently have no friends";
}

//if user is logged in function is performed, otherwise user taken to login screen
if (isset($_SESSION['loggedIn'])) {
    //var_dump($dataSet);
    require_once('Views/myFriends.phtml');
} else {
    header("Location: signIn.php");
}
