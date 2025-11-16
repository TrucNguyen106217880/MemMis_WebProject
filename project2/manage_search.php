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
	$check_box = [];
	if (isset($_GET['SO145'])) $check_box[]="SO145";
	if (isset($_GET['AI313'])) $check_box[]="AI313";
	if (isset($_GET['CY296'])) $check_box[]="CY296";
	foreach ($check_box as $x) {
        $check_box_result = mysqli_real_escape_string($conn, $x);
        $sql_valid_box[] = "reference_number = '$check_box_result'";
    }
	if (empty($sql_valid_box)) $check_sql = "1";
    else $check_sql = implode('or ', $sql_valid_box);
	if(isset($_GET["searchq"])){
	$_SESSION["searchq"] = $_GET["searchq"];
	} else $_SESSION["searchq"] = "1";
	if (isset($_GET['searchq']) || isset($_GET['SO145']) || isset($_GET['AI313']) || isset($_GET['CY296'])){
		$_SESSION["check_sql"] = $check_sql;
		$search = $_GET['searchq'];
		$search_result = mysqli_real_escape_string($conn, $search);
    	$sql3 = "SELECT eoi_number,reference_number,first_name,last_name,date_of_birth,eoi_status
				 FROM eoi WHERE ( reference_number LIKE '%$search_result%' or
								first_name LIKE '%$search_result%' or
								last_name LIKE '%$search_result%'
								) and
								($check_sql) 
								ORDER BY eoi_number"; 
		$_SESSION['search_sql'] = $sql3;
		mysqli_close($conn);
		echo header("Location:manage.php");
	} else {
		mysqli_close($conn);
		echo header("Location:manage.php");
	}
?>

</body>
</html>