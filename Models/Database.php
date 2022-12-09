<?php

class Database{
    protected static $_dbInstance = null;
    protected $_dbHandle;

    public static function getInstance(){
        if (self::$_dbInstance === null){ //If PDO doesn't exist, create new connection
            self::$_dbInstance = new self();
        }
        return self::$_dbInstance;
    }

    private function __construct(){
        try { //Creates new database connection
            $this->_dbHandle = new PDO("mysql:host=poseidon.salford.ac.uk;dbname=hc2x_21",  "hc2x-21", "Vwru8eE69ofhtGP");
        }
        catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function getDBConnection(){ //Database handle accessor
        return $this->_dbHandle;
    }

    public function __destruct(){ //Destroys database connection
        $this->_dbHandle = null;
    }
}