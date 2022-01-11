<?php

class friendData
{
    protected $friendshipID, $friendID;

    public function __construct($dbRow)
    {
        $this->friendshipID = $dbRow['friendID'];
        if (isset($dbRow['friend1'])){
            $this->friendID = $dbRow['friend1'];
        }
        else{
            $this->friendID = $dbRow['friend2'];
        }
    }

    //accessor method for variables
    public function getFriendshipID() {
        return $this->friendshipID;
    }

    public function getFriendID() {
        return $this->friendID;

    }
}