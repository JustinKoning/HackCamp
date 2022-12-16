<?php
class PermissionData
{
    protected $user_ID, $email, $products, $users, $rights, $logs;

    public function __construct($row)
    { //Populate
        $this->user_ID = $row['UID'];
        $this->email = $row['email'];
        $this->products = $row['products'];
        $this->users = $row['users'];
        $this->rights = $row['rights'];
        $this->logs = $row['logs'];
    }

    public function getUID(){
        return $this->user_ID;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getProducts(){
        return $this->products;
    }

    public function getUsers(){
        return $this->users;
    }

    public function getRights(){
        return $this->rights;
    }

    public function getLogs(){
        return $this->logs;
    }
}
