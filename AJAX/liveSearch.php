<?php
require_once('../Models/userDataSet.php');
$searchVal = $_GET['searchVal'];
$userDataSet = new userDataSet();
if ($searchVal == ""){
    echo json_encode($userDataSet);
}else{
    echo json_encode($userDataSet->fetchUserByNameLimit($searchVal));
}
