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
	if ($user == "Memmis" && $pwd == password_verify("Memmis676905#:3")){
		session_start();
		$connection = mysqli_connect($host, $user, $pwd, "jobs");
		if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
		}
	} else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM');
	$check_sql = $_SESSION['check_sql'];
	$search = $_SESSION['searchq'];
    if(isset($_POST['delete_button'])) {
        $search_result = mysqli_real_escape_string($connection, $search);
        $sql1 = "DELETE FROM eoi WHERE
									(job_reference_number = '$search_result') and
									$check_sql
        ";
        $result = mysqli_query($connection, $sql1);
		unset($_SESSION['searchq']);
		mysqli_close($connection);
        echo header('Location:manage.php');
    } else {
		mysqli_close($connection);
		echo header('Location:manage.php');
	}
?>
</body>
</html>