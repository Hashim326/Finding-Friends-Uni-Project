<?php

class userData implements JsonSerializable
{

    protected $userID, $userFirstName, $userSurname, $userPhoneNumber, $userEmail, $userPassword, $userLat, $userLong;

    public function __construct($dbRow) {
        $this->userID = $dbRow['userID'];
        $this->userFirstName = $dbRow['userFirstName'];
        $this->userSurname = $dbRow['userSurname'];
        $this->userPhoneNumber = $dbRow['userPhoneNumber'];
        $this->userEmail = $dbRow['userEmail'];
        $this->userPassword = $dbRow['userPassword'];
        $this->userLat = $dbRow['userLat'];
        $this->userLong = $dbRow['userLong'];
    }


    //Accessor for user ID
    public function getUserID() {
        return $this->userID;
    }

    //Accessor for user name
    public function getUserFirstName() {
        return $this->userFirstName;
    }

    //Accessor for user surname
    public function getUserSurname() {
        return $this->userSurname;
    }

    //Accessor for user phone number
    public function getUserPhoneNumber() {
        return $this->userPhoneNumber;
    }

    //Accessor for user email
    public function getUserEmail() {
        return $this->userEmail;
    }

    //Accessor for user password
    public function getUserPassword() {
        return $this->userPassword;
    }

    //Accessor for user latitude
    public function getUserLat() {
        return $this->userLat;
    }

    //Accessor for user longitude
    public function getUserLong() {
        return $this->userLong;
    }


    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return [
            'userID' => $this->userID,
            'firstName' => $this->userFirstName,
            'surname' => $this->userSurname,
            'phoneNumber' => $this->userPhoneNumber,
            'email' => $this->userEmail,
            'password' => $this->userPassword,
            'uLat' => $this->userLat,
            'uLong' => $this->userLong,
        ];
    }
}