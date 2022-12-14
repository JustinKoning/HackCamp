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

    public function addProduct($name, $type, $cost, $images, $owner){
        $sqlQ = 'INSERT INTO products (name, type, cost, images, owner) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $cost);
        $stmt->bindParam(4, $images);
        $stmt->bindParam(5, $owner);
        $stmt->execute();
    }

    public function addVendor($name, $address, $creator, $logo){
        $sqlQ = 'INSERT INTO vendors (name, shippingAddress, creator, logo) VALUES (?, ?, ?, ?)';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $address);
        $stmt->bindParam(3, $creator);
        $stmt->bindParam(4, $logo);
        $stmt->execute(); //Inserts vendor details

        $sqlQ = 'SELECT vendor_ID FROM vendors ORDER BY vendor_ID DESC LIMIT 1';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->execute();
        $id = $stmt->fetch()[0]; //Get autogenerated vendor id

        //Grant self full permissions
        $sqlQ = 'INSERT INTO vendor_permissions (user_ID, vendor_ID, view, products, users, rights, logs) VALUES (?, ?, 1,1,1,1,1)';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $_SESSION['UID']);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }
}
