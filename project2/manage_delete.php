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
	if (!empty($_SESSION['check_sql'])){
	$check_sql = $_SESSION['check_sql'];
	} else $check_sql='1';
	if (!empty($_SESSION['searchq'])){
	$search = $_SESSION['searchq'];
	} else $search='1';
	// mysqli_use_result($conn);
	$delete_ids = [];
    if(isset($_POST['delete_button'])) {
        $search_result = mysqli_real_escape_string($conn, $search);
		$delete_ids[] = $_SESSION["delete_ids"];
		foreach($delete_ids as $delete_id){
			$sql7 = "DELETE FROM eoi_skills WHERE eoi_number = $delete_id";
			mysqli_query($conn, $sql7);
		}
		mysqli_query($conn, $sql7);	
        $sql1 = "DELETE FROM eoi WHERE
									(reference_number LIKE '%$search_result%' or
									first_name LIKE '%$search_result%' or
									last_name LIKE '%$search_result%'
									) and
									($check_sql)
        ";
        mysqli_query($conn, $sql1);
		unset($_SESSION['searchq'], $_SESSION['check_sql'], $_SESSION['search_sql']);
		mysqli_close($conn);
        echo header('Location:manage.php');
    } else {
		mysqli_close($conn);
		echo header('Location:manage.php');
	}
?>
</body>
</html>