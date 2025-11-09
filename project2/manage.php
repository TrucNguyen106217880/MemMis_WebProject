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
			$connection = mysqli_connect($host, $user, $pwd, "jobs");
			if (!$connection) {
				die("Connection failed: " . mysqli_connect_error());
			}
		} else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM'); 
	?>
	<form method="get" action="manage_search.php">
		<input type="text" id="search" name="searchq" placeholder="Search...">
		<input type="submit" placeholder="Search">
	</form>
	<form method="post">
		<input type="checkbox" name="SO145" value="SO145">
		<label for="SO145">SO145</label>
		<input type="checkbox" name="AI313" value="AI313">
		<label for="AI313">AI313</label>
		<input type="checkbox" name="CY296" value="CY296">
		<label for="CY296">CY296</label>
	</form>
	<?php
	if (!isset($_SESSION["search_sql"])){
		$sql0 = "SELECT * FROM eoi";
	} else {
		$sql0 = $_SESSION["search_sql"];
	}
	$result = mysqli_query($connection, $sql0);
	// display table
	echo "<table border='1'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Job RefN.</th>
						<th>Name</th>
						<th>DoB</th>
						<th>Gender</th>
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
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row["eoi_number"]. "</td>" ;
			echo "<td>" . $row["job_reference_number"] . "</td>" ;
			echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>" ;
			echo "<td>" . $row["date_of_birth"] . "</td>" ;
			echo "<td>" . $row["gender"] . "</td>" ;
			echo "<td>" . $row["street_address"] . ", " . $row["suburb_town"] . ", " . $row["state"] . "</td>" ;
			echo "<td>" . $row["postcode"] . "</td>" ;
			echo "<td>" . $row["email_address"]. "</td>" ;
			echo "<td>" . $row["phone_number"] . "</td>" ;
			echo "<td>" ;
			$skill_row = [
				$row["skill_1"], $row["skill_2"], $row["skill_3"], $row["skill_4"], $row["skill_5"],
				$row["skill_6"], $row["skill_7"], $row["skill_8"], $row["skill_9"], $row["skill_10"]
			];
			$checked_skills = array_filter($skill_row);
			echo implode(", ", $checked_skills) . ".";
			echo"</td>" ;
			echo "<td>" . $row["other_skills"] . "</td>" ;
			echo "<td><form>";
			if ($row['eoi_status']=="New") {
				echo "
					<input type='checkbox' name='checkbox_status' id='new_box' disabled checked>
					<label for='new_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=New'>New</a></label>
					<input type='checkbox' name='checkbox_status' id='current_box' disabled>
					<label for='current_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Current'>Current</a></label>
					<input type='checkbox' name='checkbox_status' id='final_box' disabled>
					<label for='final_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Final'>Final</a></label>			
					" ;
			}
			if ($row['eoi_status']=="Current") {
				echo "  
					<input type='checkbox' name='checkbox_status' id='new_box' disabled>
					<label for='new_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=New'>New</a></label>
					<input type='checkbox' name='checkbox_status' id='current_box' disabled checked>
					<label for='current_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Current'>Current</a></label>
					<input type='checkbox' name='checkbox_status' id='final_box' disabled>
					<label for='final_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Final'>Final</a></label>			
					" ;
			} 
			if ($row['eoi_status']=="Final") {
				echo "  
					<input type='checkbox' name='checkbox_status' id='new_box' disabled>
					<label for='new_box><a href='manage_status.php?id=". $row["eoi_number"] . "&status=New'>New</a></lable>
					<input type='checkbox' name='checkbox_status' id='current_box' disabled>
					<label for='current_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Current'>Current</a></label>
					<input type='checkbox' name='checkbox_status' id='final_box' disabled checked>
					<label for='final_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Final'>Final</a></label>			
					" ;
			}
			echo "</form></td>";
		}
		echo "</tbody>
		</table>";
		mysqli_close($connection);
	} else {
		echo "<td colspan='12'>No record</td>";
		echo "</tbody>
		</table>";
		mysqli_close($connection);
	}
	if (isset($_SESSION['searchq'])){
	?>
	<!-- I will make a confirmation page for this -->
	<form method="post" action="manage_delete.php">
	<label for="delete_button">Please check all results BEFORE deleting:</label>
	<input type="submit" id="delete_button" name="delete_button" value="Delete">
	</form>
	<?php
	}
		include 'footer.inc';
	?>
</body>
</html>