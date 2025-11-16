<?php
	require_once 'settings.php';
	session_start();
	session_unset();
	session_destroy();
	header('Location: login.php');
	exit;
?>