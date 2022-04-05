<?php
if (isset($_POST['viewProfileButton'])) {
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    //var_dump($_POST["selecIDnumber"]);
    //var_dump($_SESSION['selectedID']);
    header("Location: viewProfile.php");
}
//Assigns values from button presses and opens corresponding pages
if (isset($_POST['addFriend'])) {
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    $_SESSION['friendAction'] = "add";
    //var_dump($_POST["selecIDnumber"]);
    //var_dump($_SESSION['selectedID']);
    header("Location: manageFriend.php");
}
//Deletes friend from button press
if (isset($_POST['deleteFriend'])) {
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    $_SESSION['friendAction'] = "del";
    header("Location: manageFriend.php");
}
//Cancels Friend request
if (isset($_POST['cancelFriend'])) {
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    $_SESSION['friendAction'] = "cancel";
    header("Location: manageFriend.php");
}
//Rejects Friend request
if (isset($_POST['rejectFriend'])) {
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    $_SESSION['friendAction'] = "reject";
    header("Location: manageFriend.php");
}
//Accepts Friend request
if (isset($_POST['acceptFriend'])) {
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    $_SESSION['friendAction'] = "accept";
    header("Location: manageFriend.php");
}