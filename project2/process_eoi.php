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
$job_reference_number = sanitize($_POST["reference_number"]);
$first_name = sanitize($_POST["first_name"] ?? "");
$last_name = sanitize($_POST["last_name"] ?? "");
$date_of_birth = sanitize($_POST["date_of_birth"] ?? "");
$gender = ucfirst(strtolower(sanitize($_POST["gender"] ?? "")));
$street_address = sanitize($_POST["street_address"] ?? "");
$suburb_town = sanitize($_POST["suburb_town"] ?? "");
$state = sanitize($_POST["state"] ?? "");
$postcode = sanitize($_POST["postcode"] ?? "");
$email_address = sanitize($_POST["email"] ?? "");
$phone_number = preg_replace("/[^\d]/", "", sanitize($_POST["phone_number"] ?? ""));
$other_skills = sanitize($_POST["other_skills"] ?? "");

// Extract skills based on selected job reference value, this means if either value for refnum or techskills is wrong, this won't work
$skills = $_POST[$job_reference_number] ?? [];
//Using ?? null ensures that we do not receive automated warning when reference_number is not selected, or when there are unchecked boxes even when reference_number was selected. This is for the sake of creating a user-friendly error page

    

// Creates a table if eoi table is missing
$create_eoi_sql = "CREATE TABLE IF NOT EXISTS eoi (
  `eoi_number` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `date_of_birth` date NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `suburb_town` varchar(50) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `other_skills` text DEFAULT NULL,
  `eoi_status` enum('New','Current','Final') DEFAULT 'New',
  PRIMARY KEY (`eoi_number`)
)";
mysqli_query($conn, $create_eoi_sql);

$create_skills_sql = "CREATE TABLE IF NOT EXISTS `eoi_skills` (
  `eoi_number` int(11) NOT NULL,
  `skills_id` int(11) NOT NULL,
  PRIMARY KEY (`eoi_number`, `skills_id`),
  CONSTRAINT `fk_eoi` FOREIGN KEY (`eoi_number`) REFERENCES `eoi` (`eoi_number`) ON DELETE CASCADE,
  CONSTRAINT `fk_skill` FOREIGN KEY (`skills_id`) REFERENCES `skills` (`skills_id`) ON DELETE CASCADE
)";

mysqli_query($conn, $create_skills_sql);

// This part with validate the collected data to match requirements, as well as changing specific inputs if needed
// This starts an empty error array that collects error messages as we go through validation
$errors = [];
// PHP has different regular expressions, I am using // as the delimiter
if (empty($job_reference_number)) $errors[] = "Job reference number is required.";
if (!preg_match("/^[a-zA-Z]{1,20}$/", $first_name)) $errors[] = "First name must be 1-20 alphabetic characters.";
if (!preg_match("/^[a-zA-Z]{1,20}$/", $last_name)) $errors[] = "Last name must be 1-20 alphabetic characters.";
if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/\d{4}$/", $date_of_birth)) {$errors[] = "Date of birth must be in dd/mm/yyyy format.";
} else {
    // This is to convert the dob to yyyy-mm-dd for successful sql insertion
    $seperate_dob = explode('/', $date_of_birth); // Breaks dob in to dd, mm,, yyyy seperately. This is the opposite of implode()!
    $date_of_birth = "{$seperate_dob[2]}-{$seperate_dob[1]}-{$seperate_dob[0]}";
}
// eoi_table  has 'other', but apply.php doesn't have it for gender 
if (!in_array($gender, ['Male', 'Female'])) $errors[] = "Gender must be selected.";
if (!preg_match("/^.{1,40}$/", $street_address)) $errors[] = "Street address must be 1-40 characters.";
if (!preg_match("/^.{1,40}$/", $suburb_town)) $errors[] = "Suburb/town must be 1-40 characters.";
if (!in_array($state, ['NSW','ACT','VIC','QLD','SA','WA','TAS','NT'])) $errors[] = "Invalid state.";
if (!preg_match("/^0[2-9][0-9]{2}|[1-9][0-9]{3}$/", $postcode)) $errors[] = "Invalid postcode.";
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email address.";
if (!preg_match("/^[\d\s]{8,12}$/", $phone_number)) $errors[] = "Phone number must be 8-12 digits or spaces.";
// This is the state-specific postcode validation that was developed by Duy and Khang 
function is_valid_postcode($state, $postcode) {
    $postcode = (int)$postcode;
    $ranges = [
        'NSW' => [[1000, 1999], [2000, 2599], [2619, 2899], [2921, 2999]],
        'ACT' => [[200, 299], [2600, 2618], [2900, 2920]],
        'VIC' => [[3000, 3999], [8000, 8999]],
        'QLD' => [[4000, 4999], [9000, 9999]],
        'SA'  => [[5000, 5799], [5800, 5999]],
        'WA'  => [[6000, 6797], [6800, 6999]],
        'TAS' => [[7000, 7799], [7800, 7999]],
        'NT'  => [[800, 899], [900, 999]],
    ];
    foreach ($ranges[$state] ?? [] as [$min, $max]) {
        if ($postcode >= $min && $postcode <= $max) return true;
    }
    return false;
}
if (!is_valid_postcode($state, $postcode)) {
    $errors[] = "Postcode does not match the selected state.";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Viet Do">
		<link rel="stylesheet" href="styles/styles.css">
		<title>Processing Form</title>
	</head>
	<body>
		<?php include 'header.inc'; $current_page='register.php'; include 'menu.inc'; ?>
		<main>
		<?php
// If errors is not empty, it will display all error messsages for failed validations
if (!empty($errors)) {
	// Creates an unordered list and list each errors as collected in the array
    echo "<h2>Application unsuccessful, please try again</h2><ul>";
	// Each error message is looped through in the collected array
    foreach ($errors as $error) {
        echo "<li class=\"notification_error\">$error</li>";
    }
    echo "</ul>" ;
	// Ends the script immediately
    exit;
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO eoi (
  reference_number, first_name, last_name, gender, date_of_birth,
  street_address, suburb_town, state, postcode, email_address, phone_number,
  other_skills
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// 
$stmt->bind_param("ssssssssssss", // There are 12 strings in total
  $job_reference_number, $first_name, $last_name, $gender, $date_of_birth,
  $street_address, $suburb_town, $state, $postcode, $email_address, $phone_number,
  $other_skills
);

$result = $stmt->execute();




    // It is reccomended to still sanitize even radio or dropdown input
// If result works succesfully, retrieve eoi number with mysqli_insert_id(record the ID auto incremented from the last insert)
if ($result) {
    $eoi_number = mysqli_insert_id($conn);
<<<<<<< Updated upstream
    foreach ($skills as $id) {
        // This will check if the skill from apply.php exists in eoi_skill
     $stmt = $conn->prepare("SELECT 1 FROM skills WHERE skills_id = ?");
     $stmt->bind_param("i", $id);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result && $result->num_rows > 0) {
    $valid_skills[] = $id;
        }
            }
            // 
=======
    $valid_skills = [];
    foreach ($skills as $id) {
     $stmt = $conn->prepare("SELECT 1 FROM skills WHERE skills_id = ?");
     $stmt->bind_param("i", $id);
     $stmt->execute();
   $skill_check = $stmt->get_result();
if ($skill_check && $skill_check->num_rows > 0) {
    $valid_skills[] = $id;
}
            }
         if (empty($valid_skills)) {
        echo "<p class=\"notification_error\">No valid skills were selected or found in the database.</p>";
        exit;
    }
>>>>>>> Stashed changes
        if (!empty($valid_skills)) {
            $values = [];
            foreach ($valid_skills as $skill_id) {
                $values[] = "($eoi_number, $skill_id)";
            }
        
            $sql = "INSERT INTO eoi_skills (eoi_number, skills_id) VALUES " . implode(", ", $values);
            $insert_skills = mysqli_query($conn, $sql);
<<<<<<< Updated upstream

            if (!$insert_skills) {
                die("Skill insert failed: " . mysqli_error($conn));
            }
        } else {
            echo "<p>No valid skills selected or found in database.</p>";
        }
    


=======
>>>>>>> Stashed changes

            if (!$insert_skills) {
                die("Skill insert failed: " . mysqli_error($conn));
            }
        }
	// This will display the EOI number
    echo "<h2 class=\"notification_success\">Application sent succesfully!</h2>";
	// EOI number is displayed and emphasized
    echo "<p class=\"notification_success\">Your EOI number is: <strong>$eoi_number</strong></p>";
}  else {
    die("SQL Error: " . mysqli_error($conn));

}

		?>
		</main>
		<footer><?php include 'footer.inc'; ?></footer>
	</body>
</html>