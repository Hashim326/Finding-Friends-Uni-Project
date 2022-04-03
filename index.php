<?php
session_start();
require_once('viewProfileController.php');
require_once('Models/userDataSet.php');
require_once('Models/friend.php');

$view = new stdClass();
$view->pageTitle = 'Homepage';

$userDataSet = new userDataSet();
$view -> userDataSet = $userDataSet->fetchAllUsers();
require_once("Views/index.phtml");


