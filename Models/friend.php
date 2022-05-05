<?php
require_once('friendsDataSet.php');

class friend
{

    //method to check if friendship already exists(not currently functioning properly)
    function checkFrienshipExists($myID, $friendID){
        $friendsDataSet = new friendsDataSet();
        if ($friendsDataSet -> friendCheck($myID, $friendID) !=  null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //Registers users friendship to the database
    function registerFriendship($myID, $friendID){
        $friendsDataSet = new friendsDataSet();
        $friendsDataSet -> registerFriendship($myID, $friendID);
    }

    function deleteFriendship($myID, $friendID){
        $friendsDataSet = new friendsDataSet();
        $friendsDataSet -> deleteFriendship($myID, $friendID);
    }

    function cancelFriendship($myID, $friendID){
        $friendsDataSet = new friendsDataSet();
        $friendsDataSet -> cancelFriendship($myID, $friendID);
    }

    function acceptFriendship($myID, $friendID){
        $friendDataSet = new friendsDataSet();
        $friendDataSet ->acceptFriendship($myID, $friendID);
    }

    function rejectFriendship($myID, $friendID){
        $friendsDataSet = new friendsDataSet();
        $friendsDataSet -> rejectFriendship($myID, $friendID);
    }
}