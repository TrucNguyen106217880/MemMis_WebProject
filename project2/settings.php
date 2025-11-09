<?php
$host="localhost";
$user="Memmis";
$pwd="Memmis676905#:3";
$sql_db=""; //Add name later

$conn=mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
	exit("Connection failed: " . mysqli_connect_error());
}
?>