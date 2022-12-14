<?php
require_once ('Models/Database.php');
require_once ('Models/ProductData.php');

class ProductDataSet{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAll(){
        $sqlQ = 'SELECT * FROM products WHERE owner = ?';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $_SESSION['UID']);
        $stmt->execute();
        $dataSet = [];
        while ($row = $stmt->fetch()){
            $dataSet[] = new ProductData($row);
        }
        return $dataSet;
    }

    public function fetchAmount(){
        $sqlQ = 'SELECT COUNT(owner) FROM products WHERE owner = ?';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $_SESSION['UID']);
        $stmt->execute();
        return $stmt->fetch()[0];
    }
}