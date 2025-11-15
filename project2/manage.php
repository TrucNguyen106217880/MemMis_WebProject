<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Group Project 2">
	<meta name="keywords" content="Management Site, MemMis, GroupProject">
	<meta name="author" content="Hoang Trong Toan">
	<link rel="stylesheet" href="styles/styles.css">
	<title>Management</title>
</head>

<body>
	<?php include 'header.inc'; $current_page='manage.php'; include 'menu.inc'; ?>

	<main>
		<?php
			session_start();
			require_once 'settings.php';
			// if ($user == "Memmis" && $pwd == "Memmis676905#:3"){
				
			// } else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM'); 
		?>
		<form method="get" action="manage_search.php">
			<input type="text" id="search" name="searchq" placeholder="Search...">
			<input type="submit" placeholder="Search" value="Search">
			<br>

			<span>Job filter:</span>
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
		$result = mysqli_query($conn, $sql0);
		// display table
		echo "<table class='table_styles'>
					<thead>
						<tr>
							<th>ID</th>
							<th>Job RefN.</th>
							<th>Name</th>
							<th>DoB</th>
							<th> </th>
						</tr>
					</thead>
					<tbody>";
		$delete_ids = [];
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$delete_ids = $row["eoi_number"];
				echo "<tr><td><a class='internal_link' href='info.php?id=". $row["eoi_number"] ."'>" . $row["eoi_number"]. "</a></td>" ;
				echo "<td>" . $row["reference_number"] . "</td>" ;
				echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>" ;
				echo "<td>" . $row["date_of_birth"] . "</td>" ;
				echo "<td align='center'><form>";
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
						<label for='new_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=New'>New</a></label>
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
			mysqli_close($conn);
		} else {
			echo "<td colspan='8' align='center'>No record found</td>";
			echo "</tbody>
			</table>";
			mysqli_close($conn);
		}
		if ((isset($_SESSION['searchq']) || isset($_SESSION['check_sql'])) && (mysqli_num_rows($result) > 0)){
		$_SESSION["delete_ids"] = $delete_ids;
		?>
		<form method="post" action="delete_confirm.php">
		<label for="delete_confirm_button">Please check all results BEFORE deleting:</label>
		<input type="submit" id="delete_confirm_button" name="delete_confirm" value="Delete Confirmation">
		</form>
		<?php
		}
			
		?>
	</main>

	<footer><?php include 'footer.inc'; ?></footer>
</body>
</html>