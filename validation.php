<?php
session_start();
ob_start();
$username = "";
$useremail = "";
$usermode = "";
$userimage = "";
$id = "";
$gender = "";
if(isset($_SESSION['twostep']) && $_SESSION['twostep']){
    $username = $_SESSION['name'];
    $useremail = $_SESSION['email'];
    $usermode = $_SESSION['mode'];
    $userimage = $_SESSION['image'];
    $id = $_SESSION['id'];
    $gender = $_SESSION['gender'];
}
else{
    header("location: logout.php");
}
?>