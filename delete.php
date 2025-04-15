<?php
include 'db_connection.php';
include 'validation.php';

if (isset($_GET['serial'])) {
    $serial = $_GET['serial'];

    $deletepostquery = "DELETE FROM problems WHERE problem_id = $serial";
    $result = mysqli_query($connection, $deletepostquery);

    header("Location: profilesettings.php");
}
?>
