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

    public function fetchAssociatedVendors($login){
        $sqlQuery = 'SELECT v.name,
        v.vendor_ID,
        v.logo,
        v.shippingAddress,
        v.creator
        FROM users u 
        INNER JOIN vendor_permissions vp
        on u.UID = vp.user_ID
        INNER JOIN vendors v
        on v.creator = vp.user_ID
        WHERE u.email = "'.$login.'" AND vp.permission_ID = 1;';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new VendorData($row);
        }
        return $dataSet;
    }
}