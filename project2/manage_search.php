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
	// if ($user == "Memmis" && $pwd == password_verify("Memmis676905#:3")){
		session_start();
		$connection = mysqli_connect($host, $user, $pwd, "jobs");
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
		}
	// } else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM');
	$check_box = [];
	if (isset($_GET['SO145'])) $check_box[]="SO145";
	if (isset($_GET['AI313'])) $check_box[]="AI313";
	if (isset($_GET['CY296'])) $check_box[]="CY296";
	foreach ($check_box as $x) {
        $check_box_result = mysqli_real_escape_string($connection, $x);
        $sql_valid_box[] = "job_reference_number = '$check_box_result'";
    }
	if (empty($sql_valid_box)) $check_sql = "0";
    else $check_sql = implode('and ', $sql_valid_box);
	if(isset($_GET["searchq"])){
	$_SESSION["searchq"] = $_GET["searchq"];
	}
	if (isset($_GET['searchq']) || isset($_GET['SO145']) || isset($_GET['AI313']) || isset($_GET['CY296']) && !empty($_GET['searchq'])){
		$_SESSION["check_sql"] = $check_sql;
		$search = $_GET['searchq'];
		$search_result = mysqli_real_escape_string($connection, $search);
    	$sql3 = "SELECT * FROM eoi WHERE ( 
										first_name LIKE '$search_result%' or
										last_name LIKE '$search_result%'
										) and
										($check_sql) 
										ORDER BY eoi_number"; 
		$_SESSION['search_sql'] = $sql3;
		mysqli_close($connection);
		echo header("Location:manage.php");
	} else {
		mysqli_close($connection);
		echo header("Location:manage.php");
	}
?>

</body>
</html>