<?php
require_once("Models/User.php");

$user = new User();
$view = new stdClass();
$view->pageTitle = 'Add Product';

if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}

if (isset($_POST['AddProduct'])){
    $imageStr = '';
    $last = array_key_last($_FILES['Images']['error']);
    foreach ($_FILES['Images']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK){
            $tmpName = $_FILES['Images']['tmp_name'][$key];
            $name = basename($_FILES['Images']['name'][$key]);
            move_uploaded_file($tmpName, 'images/' . $name);
            if ($last == $key){ //Don't append a comma to the last/only image
                $imageStr = $imageStr . $name;
            }
            else{
                $imageStr = $imageStr . $name . ',';
            }
        }
    }
    $user->addProduct($_POST['Name'], $_POST['Type'], $_POST['Cost'], $imageStr, $_GET['id']);
}

require_once('Views/add-product.phtml');
