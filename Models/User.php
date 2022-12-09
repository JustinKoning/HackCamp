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

    public function logIn($email, $password){ //Logs user in
        $hashed = '';
        $UID = '';
        $sqlQ = "SELECT password, UID FROM users WHERE email = ?";
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as $result){
            $hashed = $result[0];
            $UID = $result[1];
        }
        if (password_verify($password, $hashed)){ //Verifies password user entered is same as the one in the database
            $_SESSION["login"] = $email;
            $_SESSION['UID'] = $UID;
        }
        else {
            $_SESSION['loginError'] = 1; //Shows popup if email/password doesn't match
        }
    }

    public function logOut(){ //Logs user out
        unset($_SESSION["login"]);
        unset($_SESSION['UID']);
        session_destroy();
    }
}
