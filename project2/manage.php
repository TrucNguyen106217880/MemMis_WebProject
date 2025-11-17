<?php
	$conn = require_once __DIR__ . '/settings.php';
	session_start();

	if (empty($_SESSION['user_id'])) {
		header('Location: login.php');
		exit;
	}

	$columns = [
		'id'   => 'eoi_number',
		'job'  => 'reference_number',   
		'name' => 'last_name, first_name',
		'dob'  => 'date_of_birth',
		'status' => 'eoi_status'
	];
	$jobfilter = ['SO145','AI313','CY296'];
	// default to sorting id ascending
	$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id'; 
	$dir = isset($_GET['dir'])  ? strtolower($_GET['dir']) : 'asc';
	$searchq = isset($_GET['searchq']) ? $_GET['searchq'] : '';
	$jobsearch = isset($_GET['jobsearch']) ? $_GET['jobsearch'] : '';
	// avoiding injection through URL
	if (!array_key_exists($sort, $columns)) {
		$sort = 'id';
	}
	if (!in_array($jobsearch, $jobfilter)) {
		$jobsearch = '';
	}
	$dir = ($dir === 'desc') ? 'desc' : 'asc';
	
	$order = $columns[$sort] . ' ' . $dir;
	$sql = "SELECT eoi_number,reference_number,first_name,last_name,date_of_birth,eoi_status
			FROM eoi WHERE 
			  	(reference_number LIKE '%$searchq%' or
				first_name LIKE '%$searchq%' or
				last_name LIKE '%$searchq%')
				and (reference_number LIKE '%$jobsearch%')
			ORDER BY $order";
	$result = mysqli_query($conn, $sql);
	
	function header_link($colKey, $currentSort, $currentDir) {
		// copy
		$qs = $_GET;
		// toggle direction
		$qs['dir']  = ($currentSort === $colKey && $currentDir === 'asc') ? 'desc' : 'asc';
		$qs['sort'] = $colKey;
		// reset page when changing sort
		if (isset($qs['page'])) unset($qs['page']);
		return '?' . http_build_query($qs);
	}

	function dir_arrow($colKey, $currentSort, $currentDir) {
		if ($colKey !== $currentSort) return '';
		return $currentDir === 'asc' ? ' ▲' : ' ▼';
	}

?>
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

	<main id="manager_pages">
		<div class="notification_success">
			<p>Welcome, <?=htmlspecialchars($_SESSION['username'])?>. <a href="logout.php" class="internal_link">Log out?</a></p>
		</div>

		<form method="get">
			<label for="search">Search in reference number and names:</label>
			<input type="text" id="search" name="searchq" placeholder="Search...">
			<br>
			<span>Job filter:</span>
			<input type="radio" id="SO145" name="jobsearch" value="SO145">
			<label for="SO145">SO145</label>
			<input type="radio" id="AI313" name="jobsearch" value="AI313">
			<label for="AI313">AI313</label>
			<input type="radio" id="CY296" name="jobsearch" value="CY296">
			<label for="CY296">CY296</label>
			<input type="submit" placeholder="Search" value="Search">
			<br>
		</form>

		<table class='table_styles'>
			<thead>
				<tr>
					<th id='id_col'>
						<a href="<?php echo header_link('id', $sort, $dir); ?>">
							ID<?php echo dir_arrow('id', $sort, $dir); ?></span>
						</a>
					</th>
					<th id='jobref_col'>
						<a href="<?php echo header_link('job', $sort, $dir); ?>">
							Job RefN.<?php echo dir_arrow('job', $sort, $dir); ?></span>
						</a>
					</th>
					<th>
						<a href="<?php echo header_link('name', $sort, $dir); ?>">
							Name<?php echo dir_arrow('name', $sort, $dir); ?></span>
						</a>
					</th>
					<th id='DoB_col'>
						<a href="<?php echo header_link('dob', $sort, $dir); ?>">
							DoB<?php echo dir_arrow('dob', $sort, $dir); ?></span>
						</a>
					</th>
					<th id='status_col'>
						<a href="<?php echo header_link('status', $sort, $dir); ?>">
							Status<?php echo dir_arrow('status', $sort, $dir); ?></span>
						</a>
					</th>			
				</tr>
			</thead>
			<tbody>
		<?php
		$_SESSION["delete_ids"] = [];
		if (mysqli_num_rows($result) > 0) {
			while($row = $result->fetch_assoc()) {
				$_SESSION['delete_ids'][] = $row["eoi_number"];
				echo "<tr><td><a class='internal_link' href='info.php?id=". $row["eoi_number"] ."'>" . $row["eoi_number"]. "</a></td>" ;
				echo "<td>" . $row["reference_number"] . "</td>" ;
				echo "<td>" . htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) . "</td>" ;
				echo "<td>" . $row["date_of_birth"] . "</td>" ;
				echo "<td align='center'>";
				if ($row['eoi_status']=="New") {
					echo "
						<input type='checkbox' name='checkbox_status' id='new_box' disabled checked>
						<label for='new_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=New' id='status_new'>New</a></label>
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
						<label for='current_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Current' id='status_current'>Current</a></label>
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
						<label for='final_box'><a href='manage_status.php?id=". $row["eoi_number"] . "&status=Final' id='status_final'>Final</a></label>			
						" ;
				}
				echo "</td>";
			}
			echo "</tbody>
			</table>";
			mysqli_close($conn);
		} else {
			echo "<td colspan='5' align='center'>No record found</td>";
			echo "</tbody>
			</table>";
			mysqli_close($conn);
		}
		
		if ((isset($searchq) || isset($jobsearch)) && (mysqli_num_rows($result) > 0)){
			$_SESSION["search_sql"]="
			SELECT *
			FROM eoi WHERE 
			  	(reference_number LIKE '%$searchq%' or
				first_name LIKE '%$searchq%' or
				last_name LIKE '%$searchq%')
				and (reference_number LIKE '%$jobsearch%')
			ORDER BY eoi_number";
			echo "
			<br>
			<form method='post' action='delete_confirm.php'>
			<input type='submit' id='delete_confirm_button' name='delete_confirm' value='Delete all shown records'>
			</form> ";
		}
		?>
	</main>

	<footer><?php include 'footer.inc'; ?></footer>
</body>
</html>