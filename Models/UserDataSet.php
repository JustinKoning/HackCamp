<?php
require_once ('Models/Database.php');
require_once ('Models/UserData.php');
class UserDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAll(){ //Grabs all user information
        $sqlQ = 'SELECT * FROM users';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->execute();
        $dataSet = [];
        while ($row = $stmt->fetch()){
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }
}