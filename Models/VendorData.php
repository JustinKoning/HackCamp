<?php

class VendorData
{
    protected $id, $name, $shippingAddress, $creator, $logo;

    public function __construct($dbRow) {
        $this->id = $dbRow['vendor_ID'];
        $this->name = $dbRow['name'];
        $this->shippingAddress = $dbRow['shippingAddress'];
        if ($dbRow['logo']) $this->logo = $dbRow['logo'];
        $this->creator = $dbRow['creator'];
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getCreator() {
        return $this->creator;
    }
}