<?php
include 'db_connection.php';
include 'validate.php';

if (isset($_GET['problemid'])) {
    $problemid = $_GET['problemid'];
    $dltproblem = "DELETE FROM problems WHERE problem_id='$problemid'";
    $result = mysqli_query($connection, $dltproblem);

    header('Location: post_action.php');
}
if (isset($_GET['courseid'])) {
    $courseid = $_GET['courseid'];
    $dltproblem = "DELETE FROM studymate.courses WHERE course_id='$courseid'";
    $result = mysqli_query($connection, $dltproblem);

    header('Location: post_action.php');
}
?>