<?php
session_start();
require_once('../Models/userDataSet.php');
require_once('../Models/friendsDataSet.php');
require_once('../Models/friend.php');

$long = $_GET['long'];
$lat = $_GET['lat'];
$myID = $_SESSION['ID'];

$view = new stdClass();

$friendsDataSet = new friendsDataSet();
$view->friendsDataSet = $friendsDataSet->fetchAllFriends();

$userDataSet = new userDataSet();
$view->userDataSet = $userDataSet;

$friendIDArr = [];

$currentUserData = new userDataSet();
$view->userDataSet = $currentUserData;

foreach ($view->friendsDataSet as $friendData) {

    //var_dump($friendData);
    $friendID = $friendData->getFriendID();

    //var_dump($friendID);
    array_push($friendIDArr, $friendID);

}
$currentUserData->updateLocation($myID, $lat, $long);
//returns the user's friends locations in JSON format
echo json_encode($userDataSet->fetchUserByID($friendIDArr));