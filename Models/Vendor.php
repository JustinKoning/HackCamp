<?php
require_once("Models/Database.php");
class Vendor
{
    protected $_dbInstance, $_dbHandle;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getDBConnection();
    }
}