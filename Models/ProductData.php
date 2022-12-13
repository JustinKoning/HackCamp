<?php
class ProductData
{
    protected $_PID, $_name, $_type, $_cost, $_images, $_owner;

    public function __construct($row){ //Populate
        $this->_PID = $row['PID'];
        $this->_name = $row['name'];
        $this->_type = $row['type'];
        $this->_cost = $row['cost'];
        $this->_images = $row['images'];
        $this->_owner = $row['owner'];
    }

    public function getPID(){
        return $this->_PID;
    }

    public function getName(){
        return $this->_name;
    }

    public function getType(){
        return $this->_type;
    }

    public function getCost(){
        return $this->_cost;
    }

    public function getImages(){
        return $this->_images;
    }

    public function getOwner(){
        return $this->_owner;
    }
}