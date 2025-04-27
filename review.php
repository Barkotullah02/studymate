<?php
session_start();
include 'db_connection.php';
include 'validation.php';
if (isset($_POST['review'])){
    $courseid = $_POST['courseid'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $reviewQuery = "INSERT INTO reviews(student_id, course_id, rating, feedback) VALUES ($id, $courseid, $rating, '$feedback')";
    $saveReview = mysqli_query($connection, $reviewQuery);

    echo "<script>$('#feedback').val('');</script>";

}
?>