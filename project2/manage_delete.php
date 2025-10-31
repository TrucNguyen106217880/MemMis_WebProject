<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Group Project 2">
	<meta name="keywords" content="Management Site, MemMis, GroupProject">
	<meta name="author" content="Hoang Trong Toan">
	<title></title>
</head>
<body>
<?php
		include 'menu.inc';
		include 'header.inc';
		require_once('settings.php');
		//verifying admin
		$user=$_SESSION(stripslashes(strip_tags('')));
		$password=$_SESSION(password_verify(''));
		if ($user == "" && $password == ""){
			session_start();
			}
		else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM');
?>
	<form method="get" action="search_process.php">
		<input type="text" id="search" name="searchq" placeholder="Search...">
		<input type="submit" name="search" value="Search">
	</form>
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<input type="text" name="deleteq" placeholder="Search">
		<input type="submit" name="delete_search" value="Delete">
	</form>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<label for="SO415">SO415</label>
		<input type="checkbox" name="SO415" value="SO415 ">
		<label for="AI313">AI313</label>
		<input type="checkbox" name="AI313" value="AI313 ">
		<label for="CY296">CY296</label>
		<input type="checkbox" name="CY296" value="CY296 ">
	</form>
<?php
		$connection = mysqli_connect("admin1", $user, $password, "eoi_table");
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$check_box_1 = "";
	$check_box_2 = "";
	$check_box_3 = "";
	if (isset($_POST['SO415'])) $check_box_1='SO415';
	if (isset($_POST['AI313'])) $check_box_2='AI313';
	if (isset($_POST['CY296'])) $check_box_3='CY296';
    if (isset($_GET['deleteq'])) {
    $search = $_GET['deleteq'];
    $search_result = mysqli_real_escape_string($connection, $search);
    $sql3 = "SELECT * FROM eoi WHERE 
                                    job_reference_number LIKE '%$search_result%' and 
                                    job_reference_number LIKE '%$check_box_1%' and 
                                    job_reference_number LIKE '%$check_box_2%' and
                                    job_reference_number LIKE '%$check_box_3%') or 
                                    firstname LIKE '%$search_result%' or
                                    lastname LIKE '%$search_result%'"; 
    $result = mysqli_query($connection, $sql3);
    echo "<table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Job RefN.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Skills</th>
                        <th>Other</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["id"]. "</td>" ;
            echo "<td><form method='post'><lable for='selected_job'><input>" .$row["selected_job"] . "</form></td>" ;
            echo "<td>" . $row["firstname"]. " " . $row["lastname"] . "</td>" ;
            echo "<td>" . $row["street_address"] . ", " . $row["suburb/town"] . ", " . $row["state"] . "</td>" ;
            echo "<td>" . $row["post_code"] . "</td>" ;
            echo "<td>" . $row["email"]. "</td>" ;
            echo "<td>" . $row["phone_number"] . "</td>" ;
            echo "<td>" . $row["skill1"] . ", ". $row["skill2"] . ", ". $row["skill3"] . ", ". $row["skill4"] . "</td>" ;
            echo "<td>" . $row["other_skill"] . "</td>" ;
            echo "<td>" . $row["status"] . "</td>"  ;
        }
    } else {
        echo "<td colspan='10'>0 results</td>";
    }
    echo "</tbody></table>";
?>
    <form method="post"><label for="delete_button">Please check all results BEFORE deleting:</label><button type="submit" id="delete_button" name="delete_button" value="Delete"></button></form>
<?php
    }
    if(isset($_POST['delete_button'])) {
        $search = $_GET['deleteq'];
        $search_result = mysqli_real_escape_string($connection, $search);
        $sql1 = "DELETE FROM eoi_table WHERE
                                            job_reference_number LIKE '%$search_result%' and 
                                            job_reference_number LIKE '%$check_box_1%' and 
                                            job_reference_number LIKE '%$check_box_2%' and
                                            job_reference_number LIKE '%$check_box_3%')
        ";
        $result = mysqli_query($connection, $sql1);
        echo header('Location:manage.php');
        mysqli_close($connection);
    }
?>
</body>
</html>