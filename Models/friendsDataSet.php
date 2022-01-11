<?php

require_once ('Models/Database.php');
require_once ('Models/friendData.php');

class friendsDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }


    //Attempts to fetch all the users friends (NOT currently functioning)
    public function fetchAllFriends() {
        $myID = $_SESSION['ID'];

        $sqlQuery = 'SELECT friendID, friend1 FROM friends WHERE (relationship = 2 AND friend2 = ?)';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($myID)); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new friendData($row);
        }

        $sqlQuery = 'SELECT friendID, friend2 FROM friends WHERE (relationship = 2 AND friend1 = ?)';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($myID)); // execute the PDO statement

        while ($row = $statement->fetch()) {
            $dataSet[] = new friendData($row);
        }

        return $dataSet;
    }

    //checks if friend exists already (Not functioning properly)
    public function friendCheck($myID, $friendID){
        $sqlQuery = 'SELECT friendID, friend2 FROM friends WHERE (friend1 = ? AND friend2 = ?)';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($myID, $friendID)); // execute the PDO statement

        while ($row = $statement->fetch()) {
            $dataSet[] = new friendData($row);
        }

        $dataSet = [];
        return $dataSet;
    }

    //Creates a friendship in the database
    public function registerFriendship($myID, $friendID)
    {
        $sqlQuery = "insert into friends (friend1, friend2, relationship) values  (?,?,?)";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($myID, $friendID, 1));
    }

}