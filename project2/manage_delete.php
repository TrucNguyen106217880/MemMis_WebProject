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
	session_start();
	$check_sql = $_SESSION['check_sql'];
	$search = $_SESSION['searchq'];
    if(isset($_POST['delete_button'])) {
        $search_result = mysqli_real_escape_string($conn, $search);
        $sql1 = "DELETE FROM eoi WHERE
									(reference_number = '$search_result') and
									$check_sql
        ";
        $result = mysqli_query($conn, $sql1);
		unset($_SESSION['searchq']);
		mysqli_close($conn);
        echo header('Location:manage.php');
    } else {
		mysqli_close($conn);
		echo header('Location:manage.php');
	}
?>
</body>
</html>