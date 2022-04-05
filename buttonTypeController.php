<?php
if ($view->pageTitle == 'My Friends'){
    $friendBtn = "<input type=\"submit\" name=\"deleteFriend\" value=\"Delete Friend\" class=\"btn btn-outline-danger\" > ";
}
else if ($view->pageTitle == 'Sent Requests'){
    $friendBtn = "<input type=\"submit\" name=\"cancelFriend\" value=\"Cancel Request\" class=\"btn btn-outline-danger\" > ";
}
else if($view->pageTitle == 'Received Requests'){
    $friendBtn = "<input type=\"submit\" name=\"rejectFriend\" value=\"Reject Request\" class=\"btn btn-outline-danger\" > ";
    $acceptBtn = "<input type=\"submit\" name=\"acceptFriend\" value=\"Accept Request\" class=\"btn btn-outline-success\" > ";
}
else if (isset($_SESSION['loggedIn'])){
    $friend = new friend();
    $myID = $_SESSION['ID'];
    $friendID = $userData->getUserID();
    if ($friend->checkFrienshipExists($myID,$friendID) == true){
        $friendBtn = " ";
    }else{
        $friendBtn = "<input type=\"submit\" name=\"addFriend\" value=\"Add Friend\" class=\"btn btn-outline-secondary\" > ";
    }

}
else{
    $friendBtn = "<input type=\"submit\" name=\"addFriend\" value=\"Add Friend\" class=\"btn btn-outline-secondary\" > ";
}
