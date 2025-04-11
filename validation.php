<?php
session_start();
ob_start();
$username = "";
$useremail = "";
$usermode = "";
$userimage = "";
if(isset($_SESSION['uname'])){
    $username = $_SESSION['uname'];
    $useremail = $_SESSION['email'];
    $usermode = $_SESSION['mode'];
    $userimage = $_SESSION['image'];
}
else{
    header("location: login.php");
}
?>