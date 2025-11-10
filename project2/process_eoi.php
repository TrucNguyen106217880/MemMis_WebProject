	<!-- Development content checklist
		 Make apply.php send data to EOI table. Fundamentally finished
		 Validate input and output error screen if input is incorrect. Fundamentally finished
		 Show EOI number in a webpage when application is successful. Fundamentally finished
		 Basic security and input trimming. Fundamentally finished  -->
	
	<?php
	

	// This is to prevent accessing proccess_eoi.php directly through url
	if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit();
	}
	// This checks if the page was accessed via POST or not. If not, redirect user to apply.php and ends all script below exit(), using die() is also possible
     $conn = require __DIR__ . "/settings.php";

	
	// Trimming to clean "unsanitary" inputs and avoid SQL injection
	// Function works like assigning value to something, instead you assign a job to it
	function sanitize($data) {
    return htmlspecialchars(trim(stripslashes($data)));
	}

	// Collecting data from apply.php, and "cleaning" them to prevent sql injections
       // "?? "" " after $_POST[] means if nothing was input then it's considered an empty string, this is to prevent crashes
$job_reference_number = sanitize($_POST["reference_number"] ?? "");
$first_name = sanitize($_POST["first_name"]);
$last_name = sanitize($_POST["last_name"] ?? "");
$date_of_birth = sanitize($_POST["date_of_birth"] ?? "");
$gender = sanitize($_POST["gender"] ?? "");
$street_address = sanitize($_POST["street_address"] ?? "");
$suburb_town = sanitize($_POST["suburb_town"] ?? "");
$state = sanitize($_POST["state"] ?? "");
$postcode = sanitize($_POST["postcode"] ?? "");
$email_address = sanitize($_POST["email"] ?? "");
$phone_number = preg_replace("/[^\d]/", "", sanitize($_POST["phone_number"] ?? ""));
$other_skills = sanitize($_POST["other_skills"] ?? "");

// Extract up to skills based on selected job reference value, this means if either value for refnum or techskills is wrong, this won't work
$skills = $_POST[$job_reference_number] ?? [];

// Remember, index starts from 0 in PHP
$skill_1 = $skills[0] ?? null;
$skill_2 = $skills[1] ?? null;
$skill_3 = $skills[2] ?? null;
$skill_4 = $skills[3] ?? null;
$skill_5 = $skills[4] ?? null;
$skill_6 = $skills[5] ?? null;
$skill_7 = $skills[6] ?? null;
$skill_8 = $skills[7] ?? null;
$skill_9 = $skills[8] ?? null;
$skill_10 = $skills[9] ?? null;
// Basically, when job_reference_number is selected
// it will only select the technical skills with that job reference number name
// So, if I chose SO415, then only skills from SO415 would show up in the table, even if I did choose skills outside SO415
// I wonder if there is a shorter way to do this?

// Creates a table if eoi table is missing
$createTableSQL = "CREATE TABLE IF NOT EXISTS eoi (
   `eoi_number` INT NOT NULL AUTO_INCREMENT,
  `job_reference_number` VARCHAR(20) NOT NULL,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `gender` ENUM('Male','Female','Other') NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `street_address` VARCHAR(100) NOT NULL,
  `suburb_town` VARCHAR(50) NOT NULL,
  `state` VARCHAR(3) NOT NULL,
  `postcode` VARCHAR(4) NOT NULL,
  `email_address` VARCHAR(100) NOT NULL,
  `phone_number` VARCHAR(20) NOT NULL,
  `skill_1` VARCHAR(50) DEFAULT NULL,
  `skill_2` VARCHAR(50) DEFAULT NULL,
  `skill_3` VARCHAR(50) DEFAULT NULL,
  `skill_4` VARCHAR(50) DEFAULT NULL,
  `skill_5` VARCHAR(50) DEFAULT NULL,
  `skill_6` VARCHAR(50) DEFAULT NULL,
  `skill_7` VARCHAR(50) DEFAULT NULL,
  `skill_8` VARCHAR(50) DEFAULT NULL,
  `skill_9` VARCHAR(50) DEFAULT NULL,
  `skill_10` VARCHAR(50) DEFAULT NULL,
  `other_skills` TEXT DEFAULT NULL,
  `eoi_status` ENUM('New','Current','Final') DEFAULT 'New',
  PRIMARY KEY (`eoi_number`)
)";
mysqli_query($conn, $createTableSQL);


$query = "INSERT INTO eoi (reference_number, first_name, last_name, gender, date_of_birth, street_address, suburb_town, state, postcode, email_address, phone_number, skill_1, skill_2, skill_3, skill_4, skill_5, skill_6, skill_7, skill_8, skill_9, skill_10, other_skills) VALUES ('$job_reference_number', '$first_name', '$last_name', '$gender', '$date_of_birth', '$street_address', '$suburb_town', '$state', '$postcode', '$email_address', '$phone_number', '$skill_1', '$skill_2', '$skill_3', '$skill_4', '$skill_5', '$skill_6', '$skill_7', '$skill_8', '$skill_9', '$skill_10', '$other_skills')";
$result = mysqli_query($conn, $query);


// This part with validate the collected data to match requirements
// This starts an empty error array that collects error messages as we go through validation
$errors = [];
// PHP has different regular expressions, I am using // as the delimiter
if (empty($job_reference_number)) $errors[] = "Job reference number is required.";
if (!preg_match("/^[a-zA-Z]{1,20}^/", $first_name)) $errors[] = "First name must be 1-20 alphabetic characters.";
if (!preg_match("/^[a-zA-Z]{1,20}$/", $last_name)) $errors[] = "Last name must be 1-20 alphabetic characters.";
if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/\d{4}$/", $date_of_birth)) $errors[] = "Date of birth must be in dd/mm/yyyy format.";
// eoi_table  has 'other', but apply.php doesn't have it for gender 
if (!in_array($gender, ['male', 'female'])) $errors[] = "Gender must be selected.";
if (!preg_match("/^.{1,40}$/", $street_address)) $errors[] = "Street address must be 1-40 characters.";
if (!preg_match("/^.{1,40}$/", $suburb_town)) $errors[] = "Suburb/town must be 1-40 characters.";
if (!in_array($state, ['NSW','ACT','VIC','QLD','SA','WA','TAS','NT'])) $errors[] = "Invalid state.";
if (!preg_match("/^0[2-9][0-9]{2}|[1-9][0-9]{3}$/", $postcode)) $errors[] = "Invalid postcode.";
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email address.";
if (!preg_match("/^[\d\s]{8,12}$/", $phone_number)) $errors[] = "Phone number must be 8-12 digits or spaces.";
// If errors is not empty, it will display all error messsages for failed validations
if (!empty($errors)) {
	// Creates an unordered list and list each errors as collected in the array
    echo "<h2>Application unsuccessful, please try again</h2><ul>";
	// Each error message is looped through in the collected array
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
	// Ends the script immediately
    exit;
}
    // It is reccomended to still sanitize even radio or dropdown input
// If result works succesfully, retrieve eoi number with mysqli_insert_id(record the ID auto incremented from the last insert)
if ($result) {
    $eoi_number = mysqli_insert_id($conn);
	// This will display the EOI number
    echo "<h2>Application sent succesfully!</h2>";
	// EOI number is displayed and emphasized
    echo "<p>Your EOI number is: <strong>$eoi_number</strong></p>";
} else {
    die("SQL Error: " . mysqli_error($conn));
}

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