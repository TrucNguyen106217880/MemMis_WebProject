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
		include 'menu.inc';
		include 'header.inc';
		require_once 'settings.php';
		if ($user == "Memmis" && $pwd == "Memmis676905#:3"){
			session_start();
			$host="localhost";
			$admin_user=$_SESSION(stripslashes(strip_tags('Memmis')));
			$admin_password=$_SESSION(password_verify('Memmis676905#:3'));
			}
		else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM'); 
		$connection = mysqli_connect($host, $admin_user, $admin_password, "jobs");
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
		}
	?>
	<!-- Search bar -->
	<form method="get" action="manage_search.php">
		<input type="text" id="search" name="searchq" placeholder="Search...">
		<input type="submit" value="Search">
	</form>
	<form method="post"><!-- post method -->
		<input type="checkbox" name="SO415" value="SO415 ">
		<label for="SO415">SO415</label>
		<input type="checkbox" name="AI313" value="AI313 ">
		<label for="AI313">AI313</label>
		<input type="checkbox" name="CY296" value="CY296 ">
		<label for="CY296">CY296</label>
	</form>
	<?php
	// connection for admin
	
	if (isset($_SESSION["search_sql"])){
		$sql0 = $_SESSION["search_sql"];
	} else {
		$sql0 = "SELECT * FROM eoi";
	}
	$result = mysqli_query($connection, $sql0);
	// display table
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
			echo "<td>" .$row["selected_job"] . "</form></td>" ;
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
              				<input type='checkbox' name='checkbox_status' id='new_box' disabled checked>
							<lable for='new_box'><a href='manage_status.php?id={". $row["id"] . "}&status=New'>New</a> --</lable>
							<input type='checkbox' name='checkbox_status' id='current_box' disabled>
							<lable for='current_box'><a href='manage_status.php?id={". $row["id"] . "}&status=Current'>Current</a> --</lable>
							<input type='checkbox' name='checkbox_status' id='final_box' disabled>
							<lable for='final_box'><a href='manage_status.php?id={". $row["id"] . "}&status=Final'>Final</a> --</lable>			
						</form>
					  </td>" ;
			}
			if ($row['status']=="Current") {
				echo "<td>
						<form>  
							<input type='checkbox' name='checkbox_status' id='new_box' disabled>
							<lable for='new_box'><a href='manage_status.php?id={". $row["id"] . "}&status=New'>New</a></lable>
							<input type='checkbox' name='checkbox_status' id='current_box' disabled checked>
							<lable for='current_box'><a href='manage_status.php?id={". $row["id"] . "}&status=Current'>Current</a></lable>
							<input type='checkbox' name='checkbox_status' id='final_box' disabled>
							<lable for='final_box'><a href='manage_status.php?id={". $row["id"] . "}&status=Final'>Final</a></lable>			
						</form>
					</td>" ;
			} 
			if ($row['status']=="Final") {
				echo "<td>
						<form>  
							<input type='checkbox' name='checkbox_status' id='new_box' disabled>
							<lable for='new_box><a href='manage_status.php?id={". $row["id"] . "}&status=New'>New</a></lable>
							<input type='checkbox' name='checkbox_status' id='current_box' disabled>
							<lable for='current_box'><a href='manage_status.php?id={". $row["id"] . "}&status=Current'>Current</a></lable>
							<input type='checkbox' name='checkbox_status' id='final_box' disabled checked>
							<lable for='final_box'><a href='manage_status.php?id={". $row["id"] . "}&status=Final'>Final</a></lable>			
						</form>
					</td>" ;
			}
		}
		echo "</tbody>
		</table>";
		mysqli_close($connection);
	} else {
		echo "<td colspan='10'>No record</td>";
		echo "</tbody>
		</table>";
		mysqli_close($connection);
	}
	?>
	<form method="post" action="manage_delete.php">
	<label for="delete_button">Please check all results BEFORE deleting:</label>
	<input type="submit" id="delete_button" name="delete_button" value="Delete">
	</form>
	<?php
		include 'footer.inc';
	?>
</body>
</html>