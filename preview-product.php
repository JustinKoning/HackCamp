<?php
require_once("Models/User.php");
require_once ('Models/ProductDataSet.php');

$user = new User();
$view = new stdClass();
$view->pageTitle = 'Preview Products';
$productDataSet = new ProductDataSet();
$view->product = $productDataSet->fetchSingleProduct($_GET['id'], $_GET['pid']);

if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}


require_once('Views/preview-product.phtml');
