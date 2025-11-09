<?php
$host="localhost";
$user="root";
$pwd="";
$sql_db="jobs";

$conn=mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
	exit("Connection failed: " . mysqli_connect_error());
}
return $conn;
?>