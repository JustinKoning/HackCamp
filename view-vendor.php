<?php

require_once("Models/User.php");
require_once('Models/Vendor.php');

$user = new User();
$vendor = new Vendor($_GET['id']);
$view = new stdClass();
$view->pageTitle = 'Dashboard';
$view->vendor = $vendor;

if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}

require_once('Views/view-vendor.phtml');
