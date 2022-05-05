<?php

require_once('userDataSet.php');

class Register
{

    //Checks if passwords entered are the same
    function checkPassword($password, $repPassword){
        if($password ==  $repPassword){
            return true;
        }
        else{
            return false;
        }
    }

    //returns true if any users are found
    function checkUserExists($email){
        $userDataSet = new userDataSet();
        if ($userDataSet->fetchUserByEmail($email) !=  null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //sends user details to be added to the database
    function registerUser($name, $surname, $phoneNumber, $email, $password){
        $userDataSet = new userDataSet();
        $userDataSet ->registerUser($name, $surname, $phoneNumber, $email, $password);
    }

}