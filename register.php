<?php
require_once("Models/User.php");
$user = new User();
$view = new stdClass();
$view->pageTitle = "Register";

if (isset($_POST["Register"])){ //Call register function if submit button pressed
    $user->register($_POST["Email"], password_hash($_POST["Password"], PASSWORD_BCRYPT));
}

require_once('Views/register.phtml');