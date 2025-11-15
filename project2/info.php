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
	require_once 'settings.php';
    $id=$_GET['id'];
    $sql5 = "SELECT * FROM eoi WHERE eoi_number = $id";
	$info_result = mysqli_query($conn, $sql5);
	$info_detail = mysqli_fetch_assoc($info_result);
	echo "<h3>Applicant Personnal Information</h3>" ;
	echo "<ul>
		  <li>Applicant ID: " . $info_detail["eoi_number"]. "</li>" ;
	echo "<li>Name: " . $info_detail["first_name"] . " " . $info_detail["last_name"] . "</li>" ;
	echo "<li>Gender: " . $info_detail["gender"] . "</li>" ;
	echo "<li>Date of birth: " . $info_detail["date_of_birth"] . "</li>" ;
	echo "<li>Address: " . $info_detail["street_address"] . "," . $info_detail["suburb_town"]. "," . $info_detail["state"] . "</li>" ;
	echo "<li>Postcode: " . $info_detail["postcode"] . "</li>" ;
	echo "<li>Phone Number:" . $info_detail["phone_number"] . "</li>
		  </ul>" ;
	echo "<h3>Skills:</h3>";
	echo "Position: " . $info_detail["reference_number"] ;
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
	echo "<ol>";
	foreach($skill_desc as $f){
		echo "<li>" . htmlspecialchars($f) . "</li>" ;
	}
	if(!empty($info_detail["other_skills"])){
	echo "<ul><li>Other skills: " . htmlspecialchars($info_detail["other_skills"]) . "</li></ul>" ;
	}
	echo "</ol>";
?>
	<form action="manage.php">
		<button type="submit">Return</button>
	</form>
</body>
</html>