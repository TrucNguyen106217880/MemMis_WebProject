<?php
$host="localhost";
$user="root";
$pwd="";
$sql_db="jobs"; //Added name

$conn=mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
	exit("Connection failed: " . mysqli_connect_error());
}
return $conn;
?>