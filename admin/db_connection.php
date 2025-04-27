<?php
$host = 'localhost';
$user = "root";
$pass = '';
$db = "studymate";

$connection = mysqli_connect($host, $user, $pass, $db);

if(!$connection){
    echo "connection failed";
}
?>
