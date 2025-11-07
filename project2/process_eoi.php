	<!-- Development content checklist
		 Make apply.php send data to EOI table
		 Validate input and output error screen if input is incorrect
		 Basic security and input trimming *Fundamentally done, I think I'll look into this again after I'm done with the main content* -->
	
	<?php
	

	// This is to prevent accessing proccess_eoi.php directly through url
	if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit();
	}
	// This checks if the page was accessed via POST or not. If not, redirect user to apply.php and ends all script below exit(), using die() is also possible
     $conn = require __DIR__ . "/settings.php";

	
	// Trimming to clean "unsanitary" inputs and avoid SQL injection
	function sanitize($data) {
    return htmlspecialchars(trim(stripslashes($data)));
	}

	// Collecting data from apply.php, and "cleaning" them to prevent sql injections
       // "?? "" " after $_POST[] means if nothing was input then it's considered an empty string, this is to prevent crashes
$job_reference_number = sanitize($_POST["reference_number"] ?? "");
$first_name = sanitize($_POST["first_name"] ?? "");
$last_name = sanitize($_POST["last_name"] ?? "");
$date_of_birth = sanitize($_POST["date_of_birth"] ?? "");
$gender = sanitize($_POST["gender"] ?? "");
$street_address = sanitize($_POST["street_address"] ?? "");
$suburb_town = sanitize($_POST["suburb_town"] ?? "");
$state = strtoupper(sanitize($_POST["state"] ?? "")); // strtoupper() makes sure the input is capitalized, this is redundant for the sake of security
$postcode = str_replace(" ", "", sanitize($_POST["postcode"] ?? ""));
$email_address = sanitize($_POST["email"] ?? "");
$phone_number = preg_replace("/[^\d]/", "", sanitize($_POST["phone_number"] ?? ""));
$other_skills = sanitize($_POST["other_skills"] ?? "");

// Extract up to 8 skills based on selected job reference
$skills = $_POST[$job_reference_number] ?? [];

// Remember, index starts from 0 in coding
// I'm not sure if this is legit for array collection yet, needs more research
$skill_1 = $skills[0] ?? null;
$skill_2 = $skills[1] ?? null;
$skill_3 = $skills[2] ?? null;
$skill_4 = $skills[3] ?? null;
$skill_5 = $skills[4] ?? null;
$skill_6 = $skills[5] ?? null;
$skill_7 = $skills[6] ?? null;
$skill_8 = $skills[7] ?? null;
// Basically, when job_reference_number is selected
// it will only select the technical skills with that job reference number name
// So, if I chose SO415, then only skills from SO415 would show up in the table, even if I did choose skills outside SO415
// I wonder if there is a shorter way to do this?

// Very basic data insert

$query = "INSERT INTO eoi (job_reference_number, first_name, last_name, gender, date_of_birth, street_address, suburb_town, state, postcode, email_address, phone_number, skill_1, skill_2, skill_3, skill_4, skill_5, skill_6, skill_7, skill_8, other_skills) VALUES ('$job_reference_number', '$first_name', '$last_name', '$gender', '$date_of_birth', '$street_address', '$suburb_town', '$state', '$postcode', '$email_address', '$phone_number', '$skill_1', '$skill_2', '$skill_3', '$skill_4', '$skill_5', '$skill_6', '$skill_7', '$skill_8', '$other_skills')";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}
echo "<pre>$query</pre>";

    // It is reccomended to still sanitize even radio or dropdown input


		?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<title></title>
	</head>
	<body>
	
	</body>
</html>