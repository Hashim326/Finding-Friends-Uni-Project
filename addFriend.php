<?php
session_start();
require_once('Models/friend.php');
unset($_SESSION['errorAdd']);

//if user is logged in function is performed, otherwise user taken to login screen
if(isset($_SESSION['loggedIn'])){

        $friend = new friend();
        $myID = $_SESSION['ID'];
        $friendID = $_SESSION['selectedID'];
        //var_dump($myID);
        //var_dump($friendID);

        if($myID == $friendID){
            $_SESSION['errorAdd'] = "You cannot add yourself as a friend ";
        }
        else {
            if($friend->checkFrienshipExists($myID, $friendID) == false) {
                //var_dump($friend->checkFrienshipExists($myID, $friendID));
                $friend->registerFriendship($myID, $friendID);
                $_SESSION['errorAdd'] = "A friend request has been sent";
            }
            else{
                $_SESSION['errorAdd'] = "You are already friends with the user";
            }

        }

    require_once('Views/addFriend.phtml');

}else{
    header("Location: signIn.php");
}


