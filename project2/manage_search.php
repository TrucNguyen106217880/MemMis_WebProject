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
		// $user=$_SESSION(stripslashes(strip_tags('')));
		// $password=$_SESSION(password_verify(''));
		// if ($user == "" && $password == ""){
		// 	session_start();
		// 	}
		// else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM'); 
	?>
	<!-- Search bar -->
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<input type="text" id="search" name="searchq" placeholder="Search...">
		<input type="submit" value="Search">
	</form>
	<form method="get" action="manage_delete.php">
		<input type="text" name="deleteq" placeholder="Search...">
		<input type="submit" value="Delete">
	</form>
	<form method="post"> <!-- post method -->
		<label for="SO415">SO415</label>
		<input type="checkbox" name="SO415" value="SO415 ">
		<label for="AI313">AI313</label>
		<input type="checkbox" name="AI313" value="AI313 ">
		<label for="CY296">CY296</label>
		<input type="checkbox" name="CY296" value="CY296 ">
	</form>
	<?php
	// connection for admin
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

	if (isset($_GET['searchq'] )){
		$search = $_GET['searchq'];
		$search_result = mysqli_real_escape_string($connection, $search);
    	$sql3 = "SELECT * FROM eoi WHERE 
										job_reference_number LIKE '%$search_result%' and 
										job_reference_number LIKE '%$check_box_1%' and 
										job_reference_number LIKE '%$check_box_2%' and
										job_reference_number LIKE '%$check_box_3%') or 
										firstname LIKE '%$search_result%' or
										lastname LIKE '%$search_result%'"; 
    	$result = mysqli_query($connection, $sql3);

		if (mysqli_num_rows($result) > 0) {
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
							<th> </th>
							
						</tr>
					</thead>
					<tbody>";
			
			while($row = mysqli_fetch_assoc($result)) {
				$applicant_id = $row["id"];
    			echo "<tr><td>" . $row["id"]. "</td>" ;
				echo "<td><form method='post'><lable for='selected_job'><input>" .$row["selected_job"] . "</form></td>" ;
				echo "<td>" . $row["firstname"]. " " . $row["lastname"] . "</td>" ;
				echo "<td>" . $row["street_address"] . ", " . $row["suburb/town"] . ", " . $row["state"] . "</td>" ;
				echo "<td>" . $row["post_code"] . "</td>" ;
				echo "<td>" . $row["email"]. "</td>" ;
				echo "<td>" . $row["phone_number"] . "</td>" ;
				echo "<td>" . $row["skill1"] . ", ". $row["skill2"] . ", ". $row["skill3"] . ", ". $row["skill4"] . "</td>" ;
				echo "<td>" . $row["other_skill"] . "</td>" ;
				if ($row['status']=="New") {
				echo "<td>
						<form>
							<select>
								<option>New</option>
								<option><a href='manage_status.php?id={". $row["id"] . "}&status=Current'>Current</a></option>
								<option><a href='manage_status.php?id={". $row["id"] . "}&status=Final'>Final</a></option>
						</form>
					  </td>" ;
				}
				if ($row['status']=="Current") {
					echo "<td>
							<form>
								<select>
									<option>Current</option>
									<option><a href='manage_status.php?id={". $row["id"] . "}&status=Final'>Final</a></option>
									<option><a href='manage_status.php?id={". $row["id"] . "}&status=New'>New</a></option>
							</form>
						</td>" ;
				} 
				if ($row['status']=="Final") {
					echo "<td>
							<form>
								<select>
									<option>Final</option>
									<option><a href='manage_status.php?id={". $row["id"] . "}&status=Current'>Current</a></option>
									<option><a href='manage_status.php?id={". $row["id"] . "}&status=New'>New</a></option>
								</select
							</form>
						</td>" ;
				}
			}

		} else {
	    	echo "<td colspan='10'>0 results</td>";
		}
		echo "</tbody></table>";
		mysqli_close($connection);
	}
		include 'footer.inc';
	?>
</body>
</html>