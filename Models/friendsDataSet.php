<?php

require_once ('Database.php');
require_once ('friendData.php');

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

    public function fetchSentRequests()
    {
        $myID = $_SESSION['ID'];
        $sqlQuery = 'SELECT friendID, friend2 FROM friends WHERE (relationship = 1 AND friend1 = ?)';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($myID)); // execute the PDO statement

        $dataSet =[];
        while ($row = $statement->fetch()) {
            $dataSet[] = new friendData($row);
        }

        return $dataSet;
    }

    public function fetchRecRequests()
    {
        $myID = $_SESSION['ID'];
        $sqlQuery = 'SELECT friendID, friend1 FROM friends WHERE (relationship = 1 AND friend2 = ?)';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($myID)); // execute the PDO statement

        $dataSet =[];
        while ($row = $statement->fetch()) {
            $dataSet[] = new friendData($row);
        }

        return $dataSet;
    }

    //checks if friend exists already
    public function friendCheck($myID, $friendID){
        $sqlQuery = 'SELECT friendID, friend2 FROM friends WHERE (friend1 = ? AND friend2 = ?)';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($myID, $friendID)); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new friendData($row);
        }

        //$sqlQuery = 'SELECT friendID, friend2 FROM friends WHERE (friend1 = ? AND friend2 = ?)';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($friendID, $myID)); // execute the PDO statement

        while ($row = $statement->fetch()) {
            $dataSet[] = new friendData($row);
        }

        return $dataSet;
    }

    //Creates a friendship in the database
    public function registerFriendship($myID, $friendID)
    {
        $sqlQuery = "INSERT INTO friends (friend1, friend2, relationship) VALUES  (?,?,?)";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($myID, $friendID, 1));
    }

    public function deleteFriendship($myID, $friendID)
    {
        $sqlQuery = "DELETE FROM friends WHERE (friend1 = ? AND friend2 = ? AND relationship = ?) ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($myID, $friendID, 2));

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($friendID, $myID, 2));
    }

    public function cancelFriendship($myID, $friendID)
    {
        $sqlQuery = "DELETE FROM friends WHERE (friend1 = ? AND friend2 = ? AND relationship = ?) ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($myID, $friendID, 1));

    }

    public function rejectFriendship($myID, $friendID)
    {
        $sqlQuery = "DELETE FROM friends WHERE (friend1 = ? AND friend2 = ? AND relationship = ?) ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($friendID, $myID, 1));

    }

    public function acceptFriendship($myID, $friendID)
    {
        $sqlQuery = "UPDATE friends SET relationship = 2 WHERE (friend1 = ? AND friend2 = ? AND relationship = ?) ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute(array($friendID, $myID, 1));

    }
}