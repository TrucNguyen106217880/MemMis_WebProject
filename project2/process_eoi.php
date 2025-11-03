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
		<!-- Development content checklist
		 Make apply.php send data to EOI table
		 Validate input and output error screen if input is incorrect
		 Basic security and input trimming *Fundamentally done, I think I'll look into this again after I'm done with the main content* -->
	
	<?php
	

	// This is to prevent accessing proccess_eoi.php directly through url
	if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit();
	// This checks if the page was accessed via POST or not. If not, redirect user to apply.php and ends all script below exit(), using die() is also possible
}
require_once("settings.php")

    //Validation
	$errors = [];

	
if ($jobRef === '') $errors[] = 'Job reference is required.';
if (!preg_match('/^[A-Za-z]{1,20}$/', $firstName)) $errors[] = 'First name must be alphabetic, max 20 chars.';
if (!preg_match('/^[A-Za-z]{1,20}$/', $lastName)) $errors[] = 'Last name must be alphabetic, max 20 chars.';
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dob)) $errors[] = 'Date of birth must follow dd/mm/yyyy.';
if ($gender === '') $errors[] = 'Gender is required.';
if ($street === '' || strlen($street) > 40) $errors[] = 'Street address required, max 40 chars.';
if ($suburb === '' || strlen($suburb) > 40) $errors[] = 'Suburb/town required, max 40 chars.';
if (!in_array($state, ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'])) $errors[] = 'Invalid state.';
if (!preg_match('/^\d{4}$/', $postcode)) $errors[] = 'Postcode must be 4 digits.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format.';
if (!preg_match('/^[\d\s]{8,12}$/', $phone)) $errors[] = 'Phone must be 8-12 digits or spaces.';
if (in_array('other', $skills) && $otherSkills === '') $errors[] = 'Please describe your other skills.';

if ($errors) show_errors($errors);





	//Trimming to clean "unsanitary" inputs and avoid SQL injection
	function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
		?>
	</body>
</html>