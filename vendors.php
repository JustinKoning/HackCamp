<?php

require_once("Models/User.php");
require_once('Models/VendorDataSet.php');
require_once ('Models/ProductDataSet.php');

$user = new User();
$view = new stdClass();
$view->pageTitle = 'Vendors';

$vendorDataSet = new VendorDataSet();

$productDataSet = new ProductDataSet();

if (isset($_SESSION["login"])) {
    $view->vendorDataSet = $vendorDataSet->fetchAssociatedVendors($_SESSION["login"]);
    $view->productDataSet = $productDataSet->fetchAmount();
}

if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}

require_once('Views/vendors.phtml');
