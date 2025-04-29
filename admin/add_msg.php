<?php
include "validate.php";
include "db_connection.php";
include "clear_text.php";

if (isset($_POST['txt-msg'])) {

	$message = $_POST['txt-msg'];
	$message = escape($message);

	$msg_query = "INSERT INTO messages(message, send_by) VALUES('$message', '$full_name')";

	$msg_send = mysqli_query($connection, $msg_query);

	echo "successfully added";
	// code...
}

?>