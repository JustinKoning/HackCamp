<?php

require_once("Models/User.php");

$user = new User();
$view = new stdClass();
$view->pageTitle = 'Members';


if (isset($_POST["loginButton"])) { //Call logIn function when login button pressed using details user entered
    $user->logIn($_POST["email"], $_POST["password"]);
}

if (isset($_POST["logoutButton"])){ //Call logOut function when logout button pressed
    $user->logOut();
}

require_once('Views/members.phtml');
