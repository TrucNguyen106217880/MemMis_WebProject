<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Group Project 2">
	<meta name="keywords" content="Management Site, MemMis, GroupProject">
	<meta name="author" content="Hoang Trong Toan">
	<title>Management</title>
</head>
<body>
<?php
	require_once 'settings.php';
	if ($user == "Memmis" && $pwd == "Memmis676905#:3"){
		session_start();
		$_SESSION["admin_user"];
		$host="localhost";
		$admin_user=$_SESSION(stripslashes(strip_tags('Memmis')));
		$admin_password=$_SESSION(password_verify('Memmis676905#:3'));
		
	}
	
	else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM');
	$connection = mysqli_connect($host, $admin_user, $admin_password, "jobs");
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}
    if(isset($_POST['delete_button'])) {
        $search = $_SESSION['searchq'];
		$check_sql = $_SESSION['check_sql'];
        $search_result = mysqli_real_escape_string($connection, $search);
        $sql1 = "DELETE FROM eoi_table WHERE
                                            (job_reference_number LIKE '%$search_result%') and 
                                            $check_sql
        ";
        $result = mysqli_query($connection, $sql1);
        echo header('Location:manage.php');
        mysqli_close($connection);
    } else
	include 'footer.inc'
?>
</body>
</html>