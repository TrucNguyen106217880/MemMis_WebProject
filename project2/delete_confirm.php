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
    <h1>Delete Confirmation</h1>
	<main>
		<?php
        require_once 'settings.php';
		session_start();
		$sql4 = $_SESSION["search_sql"];
		$result = mysqli_query($conn, $sql4);
		echo "<table class='table_styles'>
					<thead>
						<tr>
							<th>ID</th>
							<th>Job RefN.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Skills</th>
							<th>Other</th>
						</tr>
					</thead>
					<tbody>";
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["eoi_number"]. "</td>" ;
				echo "<td>" . $row["reference_number"] . "</td>" ;
				echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>" ;
				echo "<td>" . $row["email_address"]. "</td>" ;
				echo "<td>" ;
				$skill_row = [
					$row["skill_1"], $row["skill_2"], $row["skill_3"], $row["skill_4"], $row["skill_5"],
					$row["skill_6"], $row["skill_7"], $row["skill_8"], $row["skill_9"], $row["skill_10"]
				];
				$checked_skills = array_filter($skill_row);
				echo implode(", ", $checked_skills) . ".";
				echo"</td>" ;
				echo "<td>" . $row["other_skills"] . "</td>" ;
			}
			echo "</tbody>
			</table>";
			mysqli_close($conn);
		?>
		<form method="post" action="manage_delete.php">
		<input type="submit" id="delete_button" name="delete_button" value="Delete">
		</form>
        <form action="manage.php">
            <button type="submit">Quit</button>
        </form>
		<?php
		}
			
		?>
	</main>
</body>
</html>