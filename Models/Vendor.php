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
        $sqlQuery = 'SELECT view, products, users, rights, logs
        FROM vendor_permissions vp
        INNER JOIN users u
        on u.email = "'.$username.'"
        WHERE "'.$this->id.'" AND u.UID= vp.user_ID';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        /* Permission IDs
        1 = View
        2 = Edit Products
        3 = View Logs
        4 = Add/Remove Users
        5 = Modify Rights
        */
        $permissions = [1 => false, 2=>false, 3=>false];
        while ($row = $statement->fetch()) {
            //$permissions[$row['permission_ID']] = true;
        }
        return $permissions;
    }
}