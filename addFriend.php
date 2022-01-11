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
                $friend->registerFriendship($myID, $friendID);
                $_SESSION['errorAdd'] = "Friendship created";
            }
            else{
                $_SESSION['errorAdd'] = "This friendship already exists";
            }

        }

    require_once('Views/addFriend.phtml');

}else{
    header("Location: signIn.php");
}


