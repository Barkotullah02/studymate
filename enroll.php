<?php
include 'validation.php';
include 'db_connection.php';
if(isset($_POST['tutor_id'])){
    $tutorid = $_POST['tutor_id'];
    $course_id = $_POST['course_id'];
    $student_id = $_POST['student_id'];
    $addclassqueery = "INSERT INTO class(course_id, student_id, tutor_id) VALUES ($course_id, $student_id, $tutorid)";
    $saveresult = mysqli_query($connection,$addclassqueery);

    if($saveresult)
    header('location:course-details.php?courseid=$course_id');

    else
        echo 'Not Enrolled';
}
?>