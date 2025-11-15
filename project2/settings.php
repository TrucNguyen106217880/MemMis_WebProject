<?php
	$host="localhost";
	$user="root";
	$pwd="";
	$sql_db="memmis_jobs";

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$conn = mysqli_init();
	$conn->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

	try {
		$conn->real_connect($host, $user, $pwd, $sql_db);
		$conn->set_charset('utf8mb4');
	} catch (mysqli_sql_exception $err) {
		exit('Database connection failed: ' . htmlspecialchars($err->getMessage()));
	}

	return $conn;
?>