<?php

require_once("Models/User.php");
require_once("Models/Vendor.php");

$user = new User();
$vendor = new Vendor($_GET['id']);
$permissions = $vendor->getUserPermissions($_SESSION["login"]);

$view = new stdClass();
$view->pageTitle = 'Manage Members';
$view->vendor = $vendor;


if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}

if (isset($_POST['addMember'])){
    if ($permissions['users'] == 1){
        $success = $vendor->addMember($_POST["email"], $_GET['id']);

        echo $success;
    }else{
        echo 'no adding permission';
    }
}

require_once('Views/members.phtml');
