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

	$check_box = [];
	if (isset($_POST['SO415'])) $check_box[]="SO415";
	if (isset($_POST['AI313'])) $check_box[]="AI313";
	if (isset($_POST['CY296'])) $check_box[]="CY296";
	foreach ($check_box as $x) {
        $check_box_result = mysqli_real_escape_string($connection, $x);
        $sql_valid_box[] = "'$check_box_result'";
    }
	if (!empty($valid_box)) {
        $checked = implode(', ', $valid_box);
		$check_sql = "job_reference_number in $checked";
    } else {
        $check_sql = "1";
    }
	$_SESSION["searchq"] = $_GET["searchq"];
	$_SESSION["check_sql"] = $check_sql;
	if (isset($_GET['searchq']) || isset($_POST['SO415']) || isset($_POST['AI313']) || isset($_POST['CY296'])){
		$search = $_GET['searchq'];
		$search_result = mysqli_real_escape_string($connection, $search);
    	$sql3 = "SELECT * FROM eoi WHERE (
										job_reference_number LIKE '%$search_result%' and 
										firstname LIKE '%$search_result%' or
										lastname LIKE '%$search_result%'
										) and
										$check_sql
										ORDER BY firstname"; 
		$_SESSION['search_sql'] = $sql3;
		mysqli_close($connection);
	} else echo header("Location:manage.php")
?>

</body>
</html>