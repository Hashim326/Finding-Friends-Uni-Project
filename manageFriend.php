<?php
session_start();
require_once('Models/friend.php');
unset($_SESSION['errorAdd']);

//if user is logged in function is performed, otherwise user taken to login screen
if (isset($_SESSION['loggedIn'])) {

    $friend = new friend();
    $myID = $_SESSION['ID'];
    $friendID = $_SESSION['selectedID'];
    //var_dump($myID);
    //var_dump($friendID);

    if (isset($_SESSION['friendAction'])) {
        if ($_SESSION['friendAction'] == "add") {
            if ($myID == $friendID) {
                $_SESSION['errorAdd'] = "You cannot add yourself as a friend ";
            } else {
                if ($friend->checkFrienshipExists($myID, $friendID) == false) {
                    //var_dump($friend->checkFrienshipExists($myID, $friendID));
                    $friend->registerFriendship($myID, $friendID);
                    $_SESSION['errorAdd'] = "A friend request has been sent";
                } else {
                    $_SESSION['errorAdd'] = "You are already friends with the user";
                }
            }
        } elseif ($_SESSION['friendAction'] == "del") {
            if ($myID == $friendID) {
                $_SESSION['errorAdd'] = "Friendship delete error";
            } else {
                if ($friend->checkFrienshipExists($myID, $friendID) == true) {
                    //var_dump($friend->checkFrienshipExists($myID, $friendID));
                    $friend->deleteFriendship($myID, $friendID);
                    $_SESSION['errorAdd'] = "You are no longer friends with this user";
                } else {
                    $_SESSION['errorAdd'] = "Friendship delete error: No friendship currently exists";
                }
            }
        } elseif ($_SESSION['friendAction'] == "accept") {
            if ($myID == $friendID) {
                $_SESSION['errorAdd'] = "There was an issue accepting this friend request";
            } else {
                if ($friend->checkFrienshipExists($myID, $friendID) == true) {
                    //var_dump($friend->checkFrienshipExists($myID, $friendID));
                    $friend->acceptFriendship($myID, $friendID);
                    $_SESSION['errorAdd'] = "This friend request has been accepted";
                } else {
                    $_SESSION['errorAdd'] = "Friendship request accept error: No request currently exists";
                }
            }
        } elseif ($_SESSION['friendAction'] == "reject") {
            if ($myID == $friendID) {
                $_SESSION['errorAdd'] = "There was an issue rejecting this friend request";
            } else {
                if ($friend->checkFrienshipExists($myID, $friendID) == true) {
                    //var_dump($friend->checkFrienshipExists($myID, $friendID));
                    $friend->rejectFriendship($myID, $friendID);
                    $_SESSION['errorAdd'] = "This friend request has been rejected";
                } else {
                    $_SESSION['errorAdd'] = "Friendship request accept error: No request currently exists";
                }
            }
        } else
            if ($_SESSION['friendAction'] == "cancel") {
                if ($myID == $friendID) {
                    $_SESSION['errorAdd'] = "Friend request cancellation error";
                } else {
                    if ($friend->checkFrienshipExists($myID, $friendID) == true) {
                        //var_dump($friend->checkFrienshipExists($myID, $friendID));
                        $friend->cancelFriendship($myID, $friendID);
                        $_SESSION['errorAdd'] = "This friend request has been cancelled";
                    } else {
                        $_SESSION['errorAdd'] = "Friendship request cancellation error: No request currently exists";
                    }
                }
            }
    } else {
        $_SESSION['errorAdd'] = "No action was selected, please return to the previous page";
    }

    unset($_SESSION['friendAction']);
    require_once('Views/manageFriend.phtml');

} else {
    header("Location: signIn.php");
}


