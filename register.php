<?php
require_once("Models/User.php");
$user = new User();
$view = new stdClass();
$view->pageTitle = "Register";

if (isset($_POST["Register"])){ //Call register function if submit button pressed
    $user->register($_POST["Email"], password_hash($_POST["Password"], PASSWORD_BCRYPT));
}

if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}


require_once('Views/register.phtml');
