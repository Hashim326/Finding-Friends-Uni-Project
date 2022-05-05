<?php

require_once ('Database.php');
require_once ('userData.php');


class userDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    //randomly fetches some users to be displayed
    public function fetchAllUsers() {
        $sqlQuery = 'SELECT * FROM users ORDER BY RAND() LIMIT 12';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new userData($row);
        }
        return $dataSet;
    }

    //used to a fetch user by email
    public function fetchUserByEmail($email) {
        $sqlQuery = 'SELECT * FROM users WHERE userEmail = ?';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($email)); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new userData($row);
        }
        return $dataSet;
    }

    public function fetchUserByName($name) {
        $sqlQuery = "SELECT * FROM users WHERE userFirstName LIKE ? or userSurname LIKE ?";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array("%$name%", "%$name%")); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new userData($row);
        }
        return $dataSet;
    }

    //fetches user by their ID
    public function fetchUserByID($ID) {

        if (is_array($ID)) {
            $sqlQuery = "SELECT * FROM users WHERE userID IN (".implode(',', $ID).")";
            $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        else {
            $sqlQuery = 'SELECT * FROM users WHERE userID = ?';
            $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(array($ID)); // execute the PDO statement
        }



        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new userData($row);
        }
        return $dataSet;
    }

    //adds a new user to the database
    public function registerUser($name,$surname,$phone,$email,$password)
    {
        $lat = (rand(9000000, -9000000)/100000);
        $long = (rand(18000000, -18000000)/100000);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        //echo ($password . "  " . $passwordHash);
        $sqlQuery = "insert into users (userFirstName, userSurname, userPhoneNumber, userEmail, userPassword, userLat, userLong) values  (?,?,?,?,?,?,?)";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($name,$surname,$phone, $email,$passwordHash,$lat,$long));
    }

    public function updateLocation($ID, $userLat, $userLong)
    {
        $sqlQuery = "UPDATE users SET userLat = ?, userLong =? WHERE (userID = ?) ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($userLat, $userLong, $ID));
    }
}