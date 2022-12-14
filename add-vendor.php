<?php
require_once("Models/User.php");

$user = new User();
$view = new stdClass();
$view->pageTitle = 'Add Vendor';

if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}

if (isset($_POST['AddVendor'])){
    $tmpName = $_FILES['Images']['tmp_name'][0];
    $name = basename($_FILES['Images']['name'][0]);
    move_uploaded_file($tmpName, 'images/' . $name);
    $user->addVendor($_POST['Name'], $_POST['Address'], $_SESSION['UID'], $name);
}


require_once('Views/add-vendor.phtml');
