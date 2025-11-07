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
		include 'nav.inc';
		include 'header.inc';
		require_once('settings.php');
	?>
	<?php //verifying admin
		$user=$_SESSION(stripslashes(strip_tags('')));
		$password=$_SESSION(password_verify(''));
		if ($user == "" && $password == ""){
			session_start();
			}
		else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM'); 
			// turn this back some other time when we decide what to do if it's not the admin tryin to get in
	?>

	<!-- Search bar -->
	<form method="get" action="">
		<input type="text" id="search" placeholder="Search...">
		<label for="SO415">SO415</label>
		<input type="checkbox" name="SO415" value="SO415 ">
		<label for="AI313">AI313</label>
		<input type="checkbox" name="AI313" value="AI313 ">
		<label for="CY296">CY296</label>
		<input type="checkbox" name="CY296" value="CY296 ">
		<input type="submit" name="searchq" value="Search">
	</form>
	
	<?php
	// connection for admin, team decide later
		$connection = mysqli_connect(null, null, "", "db_name");
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}
	// checkbox value
	$check_box_1 = "";
	$check_box_2 = "";
	$check_box_3 = "";
	if (isset($_GET['SO415'])) $check_box_1='SO415';
	if (isset($_GET['AI313'])) $check_box_2='AI313';
	if (isset($_GET['CY296'])) $check_box_3='CY296';
	// db_search process
	if (isset($_GET['searchq'] )){
		$search = $_GET['searchq'];
		$search_result = mysqli_real_escape_string($connection, $search);
    	$sql3 = "SELECT * FROM jobs WHERE 
										job_id LIKE '%$search_result%' and 
										job_id LIKE '%$check_box_1%' and 
										job_id LIKE '%$check_box_2%' and
										job_id LIKE '%$check_box_3%') or 
										application_name LIKE '%$search_result%'";
    	$result = mysqli_query($connection, $sql3);
	// display result
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
				
    			echo "<tr><td>" . $row["id"]. "</td>" ;
				echo "<td><form method='post'><lable for='selected_job'><input>" .
						 $row["selected_job"] . 
					 "</form></td>" ;
				echo "<td>" . $row["firstname"]. " " . $row["lastname"] . "</td>" ;
				echo "<td>" . $row["street_address"] . ", " . $row["suburb/town"] . ", " . $row["state"] . "</td>" ;
				echo "<td>" . $row["post_code"] . "</td>" ;
				echo "<td>" . $row["email"]. "</td>" ;
				echo "<td>" . $row["phone_number"] . "</td>" ;
				echo "<td>" . $row["skills"] . "</td>" ;
				echo "<td>" . $row["other_skill"] . "</td>" ;
				echo "<td>" . $row["status"] . "</td>"  ;
				//  work in progress
				// "<td><form>
				// 	     <button
				// 			
				// </form></td>"
				

  			}
		} 
		
		else {
	    	echo "<td colspan='10'>0 results</td>";
		}
		echo "</tbody></table>";
	}
		include 'footer.inc';

	//  admin exclusive exit process
	// 	echo "<form method='post'><input type='submit' name='exit_save' placeholder='Logout and Save'></form>" ;
	// 	echo "<form method='post'><input type='submit' name='exit' placeholder='Logout'></form>" ;
	// 	$exit_save=$_POST['exit_save'];
		
	// 	$exit=$_POST['exit'];
	// 	if (isset($exit_save)){
	// 		session_destroy();
	// 	}
	// 	if (isset($exit)){
	// 		// mysqli_rollback($connection, $checkpoint);
	// 		session_destroy();
	//	}

	// script for changing status
// <form method='post'>
// 	   <
//     <select>
//         <option name="new">New</option>
//         <option name="current">Current</option>
//         <option name="final">Final</option>
//     </select>
// </form>
	?>
</body>
</html>