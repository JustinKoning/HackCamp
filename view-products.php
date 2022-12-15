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

if (isset($_POST['Edit'])) {
    //Image handling
    $imageStr = '';
    if ($_FILES['Images']['error'][0] != 0) { //If user hasn't uploaded new images
        $imageStr = $productDataSet->fetchAll($_GET['id'])[$_GET['pid']-1]->getImageStr(); //Fetch current images
    } else {
        $last = array_key_last($_FILES['Images']['error']);
        foreach ($_FILES['Images']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmpName = $_FILES['Images']['tmp_name'][$key];
                $name = basename($_FILES['Images']['name'][$key]);
                move_uploaded_file($tmpName, 'images/' . $name);
                if ($last == $key) { //Don't append a comma to the last/only image
                    $imageStr = $imageStr . $name;
                } else {
                    $imageStr = $imageStr . $name . ',';
                }
            }
        }
    }
    $isVisible = '';
    if (isset($_POST['visibilityCheck'])){
        $isVisible = 'checked';
    }
    $view->productDataSet = $productDataSet->editProduct($_GET['pid'], $_POST['Name'], $_POST['Type'], ltrim($_POST['Cost'], '£'), $imageStr, $isVisible);
    $view->productTable = $productDataSet->fetchAll($_GET['id']); //Refresh table after upload
}


require_once('Views/view-products.phtml');
