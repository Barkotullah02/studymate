<?php
session_start();
include "db_connection.php";


if (!isset($_SESSION['username'])) {

        header("Location: admin_login.php");
}
else if (isset($_SESSION['username'])) {

if ($_SESSION['role'] == "admin") {

    $db_username = $_SESSION['username'];
    $db_password = $_SESSION['password'];
    $full_name = $_SESSION['full_name'];
    $role = $_SESSION['role'];
    $image = $_SESSION['image'];

}

/*
* Throwing out if the user isn't admin
*/
else if ($_SESSION['role'] != "admin") {

    header("Location: admin_login.php");
}

}


?>