<?php
session_start();

	$_SESSION['username'] = null;
	$_SESSION['password'] = null;
	$_SESSION['image'] = null;
	$_SESSION['full_name'] = null;
	$_SESSION['role'] = null;

	header("Location: index.php");
?>