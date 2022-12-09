<?php

require_once ('Models/Database.php');
require_once ('Models/VendorData.php');

class VendorDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAssociatedVendors($name){
        $sqlQuery = 'SELECT * FROM vendors';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new VendorData($row);
        }
        return $dataSet;
    }
}