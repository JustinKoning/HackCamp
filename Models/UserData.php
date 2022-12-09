<?php

class UserData{
    protected $_UID, $_email, $_password;

    public function __construct($row){ //Populate
        $this->_UID = $row['UID'];
        $this->_email = $row['email'];
        $this->_password = $row['password'];
    }

    //Accessors
    public function getUID(){
        return $this->_UID;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getPassword(){
        return $this->_password;
    }
}