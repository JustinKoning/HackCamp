<?php

require_once("Models/User.php");
require_once('Models/VendorDataSet.php');

$user = new User();
$view = new stdClass();
$view->pageTitle = 'Homepage';

$vendorDataSet = new VendorDataSet();
$view->vendorDataSet = $vendorDataSet->fetchAssociatedVendors('1');

require_once('Views/vendors.phtml');
