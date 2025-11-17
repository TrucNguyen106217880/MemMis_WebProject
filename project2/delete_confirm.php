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
	<main id=manager_pages>
		<h1>Delete Confirmation</h1>
		<?php
        require_once 'settings.php';
		session_start();
		if (!isset($_SESSION['user_id'])) {
			header("Location: login.php");
			exit();
		}		
		if ($_SERVER["REQUEST_METHOD"] !== "POST") {
			mysqli_close($conn);
			header("Location: manage.php");
			exit();
		}
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
				echo "<td>" . htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) . "</td>" ;
				echo "<td>" . htmlspecialchars($row["email_address"]). "</td>" ;
				echo "<td><ul>";
				$id = $row["eoi_number"];
				$sql6 = "SELECT skills_id FROM eoi_skills WHERE eoi_number = $id";
				$skill_result = mysqli_query($conn, $sql6);
				$skill_desc = [];
				while($skill_row = mysqli_fetch_assoc($skill_result)){
					$skill_id = $skill_row['skills_id'];
					$skill_sql = mysqli_query($conn, "SELECT skills FROM skills WHERE skills_id = $skill_id");
					$skill_data = mysqli_fetch_assoc($skill_sql);
					if($skill_data){
						$skill_desc[]= $skill_data['skills'];
					}
				}
				foreach($skill_desc as $f){
					echo "<li>" . htmlspecialchars($f) . "</li>" ;
				}
				echo "</ul></td>";
				echo "<td>" . htmlspecialchars($row["other_skills"]) . "</td>" ;
			}
			echo "</tbody>
			</table>";
			mysqli_close($conn);
		?>
		<form method="post" action="manage_delete.php">
		<input type="submit" id="delete_button" name="delete_button" value="Delete">
		</form>
        <form action="manage.php">
            <input type="submit" value="Quit"></input>
        </form>
		<?php
		}
			
		?>
	</main>
	<footer><?php include 'footer.inc'; ?></footer>
</body>
</html>