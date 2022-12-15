<?php
require_once ('Models/Database.php');
require_once ('Models/ProductData.php');

class ProductDataSet{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAll($id){
        $sqlQ = 'SELECT * FROM products WHERE owner = ?';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $dataSet = [];
        while ($row = $stmt->fetch()){
            $dataSet[] = new ProductData($row);
        }
        return $dataSet;
    }

    public function fetchAmount($id){
        $sqlQ = 'SELECT COUNT(owner) FROM products WHERE owner = ?';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch()[0];
    }

    public function searchAll($searchData, $id){ //Searches database
        $searchData = '%' . $searchData . '%'; //SQL format
        $sqlQ = 'SELECT * FROM products WHERE owner = ? AND CONCAT(name, type) LIKE ?';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $searchData);
        $stmt->execute();
        $dataSet = [];
        while ($row = $stmt->fetch()){
            $dataSet[] = new ProductData($row);
        }
        return $dataSet;
    }

    public function fetchValue($id){
        $sqlQ = 'SELECT IFNULL(total, 0) FROM (
	             SELECT ROUND(SUM(cost), 2) AS "total" FROM products where owner = ?
                 ) results';
        $stmt = $this->_dbHandle->prepare($sqlQ);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch()[0];
    }
}