<?php
$host="localhost";
$user="root";
$pwd="";
$sql_db=""; //Add name later

$conn=mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
	exit("Connection failed: " . mysqli_connect_error());
}
?>