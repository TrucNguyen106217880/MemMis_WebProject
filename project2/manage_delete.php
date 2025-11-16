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
	if (!isset($_SESSION['user_id'])) {
		header("Location: login.php");
		exit();
	}	
	if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		mysqli_close($conn);
		header("Location: manage.php");
		exit();
	}
	// mysqli_use_result($conn);
    if(isset($_POST['delete_button'])) {
        $search_result = mysqli_real_escape_string($conn, $search);
		foreach($_SESSION["delete_ids"] as $delete_id){
			$sql7 = "DELETE FROM eoi_skills WHERE eoi_number = $delete_id";
			mysqli_query($conn, $sql7);	
			$sql1 = "DELETE FROM eoi WHERE
										eoi_number = $delete_id
			";
        	mysqli_query($conn, $sql1);
		}
		unset($_SESSION['search_sql'], $_SESSION["delete_ids"]);
		mysqli_close($conn);
        echo header('Location:manage.php');
    } else {
		mysqli_close($conn);
		echo header('Location:manage.php');
	}
?>
</body>
</html>