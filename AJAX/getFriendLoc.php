<?php
session_start();
require_once('../Models/userDataSet.php');
require_once('../Models/friendsDataSet.php');
require_once('../Models/friend.php');

$long = $_GET['long'];
$lat = $_GET['lat'];
$myID = $_SESSION['ID'];

$friendsDataSet = new friendsDataSet();
$friendsDataSet = $friendsDataSet->fetchAllFriends();

$userDataSet = new userDataSet();

$friendIDArr = [];

$currentUserData = new userDataSet();

//retrieves all the users friend's IDs
foreach ($friendsDataSet as $friendData) {

    //var_dump($friendData);
    $friendID = $friendData->getFriendID();

    //var_dump($friendID);
    array_push($friendIDArr, $friendID);

}
//updates the users last known location in the database
$currentUserData->updateLocation($myID, $lat, $long);

//returns the user's friends in JSON format
echo json_encode($userDataSet->fetchUserByID($friendIDArr));