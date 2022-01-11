<?php

class  Database
{
    //A static instance to ensure the connection is only created once
    protected static $_dbInstance = null;
    //the handle containing the connection statement
    protected $_dbHandle;

    /**
     * @return Database
     */
    public static function getInstance() {
        $host = 'agd643.poseidon.salford.ac.uk';
        $dbName = 'agd643';
        $user = 'agd643';
        $pass = '7Gsv6QR5FWho2pl';

        if(self::$_dbInstance === null) { //checks if the PDO exists
            // creates new instance if not, sending in connection info
            self::$_dbInstance = new self($user, $pass, $host, $dbName);
        }

        return self::$_dbInstance;
    }


    private function __construct($user, $pass, $host, $database) {
        try {
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database",  $user, $pass); // creates the database handle with connection info
            // creates the database handle with connection info

        }
        catch (PDOException $e) { // catch any failure to connect to the database
            echo $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getdbConnection() {
        return $this->_dbHandle; // returns the PDO handle to be used elsewhere
    }

    public function __destruct() {
        $this->_dbHandle = null; // destroys the PDO handle when no longer needed
    }

}
