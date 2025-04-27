<?php
include 'db_connection.php';
include 'validation.php';

if (isset($_POST['coursereport'])) {
    echo 'reported';
    $courseid = $_POST['courseid'];
    $description = $_POST['description'];
    $reportquery = "INSERT INTO reports (course_id, description) VALUES ($courseid, '$description')";
    $result = mysqli_query($connection, $reportquery);
    if ($result) {
        echo 'reported';
    }
}
if (isset($_POST['problemreport'])) {
    echo 'reported';
    $problemid = $_POST['problemid'];
    $description = $_POST['description'];
    $reportquery = "INSERT INTO reports (problem_id, description) VALUES ($problemid, '$description')";
    $result = mysqli_query($connection, $reportquery);
    if ($result) {
        echo 'reported';
    }
}


?>
