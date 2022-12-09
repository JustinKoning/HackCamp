<?php

require_once('Models/VendorDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Homepage';

$vendorDataSet = new VendorDataSet();
$view->vendorDataSet = $vendorDataSet->fetchAssociatedVendors('1');

require_once("logincontroller.php");

require_once('Views/vendors.phtml');