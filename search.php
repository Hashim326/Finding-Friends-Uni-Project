<?php
session_start();
require_once('buttonController.php');
unset($_SESSION['searchVal']);
require_once('Models/userDataSet.php');
require_once('Models/friend.php');

$view = new stdClass();
$view->pageTitle = 'Search Page';

$userDataSet = new userDataSet();
$view->userDataSet = $userDataSet;

//creates the token used for authenticating session in AJAX
$token = substr(str_shuffle(MD5(microtime())), 0, 20);
$_SESSION['authToken'] = $token;

require_once('searchController.php');

require_once('Views/serach.phtml');
