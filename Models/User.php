<?php
require_once("Models/Database.php");
class User {
    protected $_dbInstance, $_dbHandle;

    public function __construct() {
        session_start(); //Start tracking user
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getDBConnection();
    }

    public function register($email, $password){ //Adds user details to database
        $sqlQ = "INSERT INTO users (email, password) values (?, ?)";
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        $stmt->execute();
    }
}