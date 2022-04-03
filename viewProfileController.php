<?php
if(isset($_POST['viewProfileButton'])){
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    //var_dump($_POST["selecIDnumber"]);
    //var_dump($_SESSION['selectedID']);
    header("Location: viewProfile.php");
}
//Assigns values from button presses and opens corresponding pages
if(isset($_POST['addFriend'])){
    $_SESSION['selectedID'] = $_POST["selecIDnumber"];
    //var_dump($_POST["selecIDnumber"]);
    //var_dump($_SESSION['selectedID']);
    header("Location: addFriend.php");
}