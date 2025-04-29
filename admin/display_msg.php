<?php
include "validate.php";
include "db_connection.php";

$data = "SELECT * FROM messages order by ID desc";
$fetch = mysqli_query($connection, $data);

while ($row = mysqli_fetch_assoc($fetch)) {
	$msg = $row['message'];
	$sender = $row['send_by'];

	if ($sender == $full_name) {
		echo "<div style='width: 100%; text-align:right;'>{$sender}<blockquote class='blockquote-reverse'>
                        <footer class='blockquote-footer' id='m-body'>{$msg}</footer>
                    </blockquote></div>";
	}
	else if ($sender != $full_name) {
		echo "<div style='width:100%; float:left;'>{$sender}<blockquote class='blockquote'>
                        <footer class='blockquote-footer' id='m-body'>{$msg}</footer>
                    </blockquote></div>";
	}

	
}
?>