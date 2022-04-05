<?php
session_start();
require_once('buttonController.php');
unset($_SESSION['searchVal']);
require_once('Models/userDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Search Page';

$userDataSet = new userDataSet();
$view->userDataSet = $userDataSet;

require_once('searchController.php');

require_once('Views/serach.phtml');
