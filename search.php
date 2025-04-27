<?php
session_start();
include 'db_connection.php';
include 'validation.php';
if (isset($_POST['post'])) {
    $search = $_POST['search'];
    if (empty($search)) {
        echo "";
    }
    else {
        $searchquery = "SELECT image, title, course_id, SUBSTRING_INDEX(description, ' ', 10) as description FROM courses WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $result = mysqli_query($connection, $searchquery);
        echo "<table class='table'><tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr scope='row'>";
            echo "<td> <img style='width: 40px;' src='img/coursecovers/" . $row['image'] . "'></td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td><a href='course-details.php?courseid=" . $row['course_id'] . "'>View more</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
}
if (isset($_POST['problems'])){
    $search = $_POST['search'];
    if (empty($search)) {
        echo "";
    }
    else {
        $searchquery = "SELECT problem_img, title, problem_id, SUBSTRING_INDEX(description, ' ', 10) as description FROM problems WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $result = mysqli_query($connection, $searchquery);
        echo "<table class='table'><tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr scope='row'>";
            echo "<td> <img style='width: 60px;' src='img/problems/" . $row['problem_img'] . "'></td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td><a href='single-post.php?problemid=" . $row['problem_id'] . "'>View more</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
}

?>
