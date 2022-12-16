<?php
require_once("Models/Database.php");
require_once("Models/PermissionData.php");

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

    public function addMember($username, $vendorid){
        $sqlQuery = 'INSERT INTO vendor_permissions (user_ID, vendor_ID) 
        VALUES (
            (SELECT UID FROM users WHERE email = "'.$username.'"),
            '.$vendorid.'
        )';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        return true;
    }

    public function getMembers(){
        $sqlQuery = 'SELECT vp.products, vp.users, vp.rights, vp.logs, u.email, u.UID
        FROM vendor_permissions vp
        INNER JOIN users u 
        on u.UID = vp.user_ID
        WHERE vp.vendor_ID = '.$this->id . ';';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new PermissionData($row);
        }
        return $dataSet;
    }

    public function getCreatorId(){
        $sqlQuery = 'SELECT creator FROM vendors WHERE vendor_ID = '.$this->id;

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        return $statement->fetch();
    }
}