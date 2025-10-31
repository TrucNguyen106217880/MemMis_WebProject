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
	<!-- Search bar -->
	<form method="get" action="search_process.php">
		<input type="text" id="search" name="searchq" placeholder="Search...">
		<input type="submit" value="Search">
	</form>
	<form method="get" action="delete_process.php">
		<input type="text" name="deleteq" placeholder="Search...">
		<input type="submit" value="Delete">
	</form>
	<form method="post">
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
    $sql0 = "SELECT * FROM";
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
		echo "</tbody>
		</table>";
		mysqli_close($connection);
	} else {
		echo "<td colspan='10'>0 results</td>";
		echo "</tbody>
		</table>";
		mysqli_close($connection);
	}
		include 'footer.inc';
	?>
</body>
</html>