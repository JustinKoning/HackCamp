<?php
require_once("Models/Database.php");
class Vendor
{
    protected $_dbInstance, $_dbHandle, $id;

    public function __construct($id)
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getDBConnection();
        $this->id = $id;
    }

    public function getUserPermissions($username)
    {
        $sqlQuery = 'SELECT * 
        FROM vendor_permissions vp
        INNER JOIN users u
        on u.email = "'.$username.'"
        WHERE vp.vendor_ID = "'.$this->id.'" AND u.UID= vp.user_ID;';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        return $statement->fetch();
    }
}