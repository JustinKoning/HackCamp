<?php
require_once("Models/User.php");
require_once ('Models/ProductDataSet.php');

$user = new User();
$view = new stdClass();
$view->pageTitle = 'My Products';
$productDataSet = new ProductDataSet();
$view->productTable = $productDataSet->fetchAll($_GET['id']);

if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}

if (isset($_POST['searchBtn'])){
    $view->productTable = $productDataSet->searchAll($_POST['searchBar'], $_GET['id']);
}



require_once('Views/view-products.phtml');
