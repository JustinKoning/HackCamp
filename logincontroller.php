<?php
session_start();

//var_dump($_SESSION);

if (isset($_POST["loginbutton"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    echo $username;
    echo $password;

    if ($username == "a" && $password == "b") {
       // better would be to check these variables against your database

        // SELECT * FROM usertable WHERE username=$username AND password=$password
        // if number of rows returned > 0 then the username and password matched


        echo "You are logged in";
        $_SESSION["login"] = $username;
    }
    else
    {
        echo "Error in username and password";
    }
}

if (isset($_POST["logoutbutton"]))
{
    echo "logout user";
    unset($_SESSION["login"]);
    session_destroy();
}
