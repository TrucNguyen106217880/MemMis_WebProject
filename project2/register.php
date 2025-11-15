<?php
	$conn = require_once __DIR__ . '/settings.php';
	session_start();

	$errors = [];
	$success = '';

	$create_table="CREATE TABLE IF NOT EXISTS users (
		id INT AUTO_INCREMENT,
		username VARCHAR(100) NOT NULL UNIQUE,
		password_hash VARCHAR(255) NOT NULL,
		created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		failed_attempts INT NOT NULL DEFAULT 0,
		lockout_until DATETIME DEFAULT NULL,
		PRIMARY KEY (`id`)
	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
	mysqli_query($conn, $create_table);
	
	// Check how many manager account is already created
	$count_stmt = $conn->prepare("SELECT COUNT(*) FROM users");
	$count_stmt->execute();
	$count_stmt->bind_result($manager_count);
	$count_stmt->fetch();
	$count_stmt->close();
	$limit = "";
	if ($manager_count >= 2) {
		$limit = "<p>Registration limit reached. Only 2 manager accounts are allowed.</p>";
	}
	else {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = trim($_POST['username'] ?? '');
			$password = $_POST['password'] ?? '';
			$confirm = $_POST['confirm'] ?? '';
		
			// Basic validations
			if ($username === '') $errors[] = 'Username is required.';
			if ($password === '') $errors[] = 'Password is required.';
			if ($password !== $confirm) $errors[] = 'Password and confirmation do not match.';
		
			// Password policy
			if (strlen($password) < 8) $errors[] = 'Password must be at least 8 characters.';
			if (!preg_match('/[A-Z]/', $password)) $errors[] = 'Password must contain at least one uppercase letter.';
			if (!preg_match('/[a-z]/', $password)) $errors[] = 'Password must contain at least one lowercase letter.';
			if (!preg_match('/\d/', $password)) $errors[] = 'Password must contain at least one number.';
		
			
			if (empty($errors)) {
				// Check username uniqueness
				$stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
				$stmt->bind_param('s', $username);
				$stmt->execute();
				$result = $stmt->get_result();
				$dupe = $result->fetch_assoc();
				if (!empty($dupe)) {
					$errors[] = 'Username already exists. Choose another.';
				} 
				else {
					$hash = password_hash($password, PASSWORD_DEFAULT);
					$insert = $conn->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
					$insert->bind_param('ss', $username, $hash);
					$insert->execute();
					$insert->close();
					$success = 'Registration successful.';
				}
				$stmt->close();
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Truc Nguyen 106217880">
		<link rel="stylesheet" href="styles/styles.css">
		<title>Manager Registration</title>
	</head>
	<body>
		<?php include 'header.inc'; $current_page='register.php'; include 'menu.inc'; ?>			

		<main id="manager_pages">
			<?php if ($limit): ?>
				<div class="notification_error">
					<?= $limit ?>
					<?= "<p>Please <a href='login.php' class='internal_link'>login</a></p>" ?>
				</div>
			<?php endif; ?>

			<?php if ($errors): ?>
				<div class="notification_error">
					<ul>
						<?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ($success): ?>
				<div class="notification_success">
					<?=htmlspecialchars($success)?>
					<?="You can now <a href='login.php' class='internal_link'>login</a>"?>
				</div>
			<?php endif; ?>

			<form method="post" action="">
				<label for="username">Username</label>
				<!-- Keeping the previous username input -->
				<input type="text" id="username" name="username" value="<?=htmlspecialchars($username ?? '')?>" required>
				<br>
				<label for="password">Password</label>
				<input type="password" id="password" name="password" 
					   title="Password must be at least 8 characters. 
Must contain at least one uppercase, one lowercase and one number." required>
				<br>
				<label for="conf_password">Confirm Password</label>
				<input type="password" id="conf_password" name="confirm" required>
				<br>
				<input type="submit" value="Register"></input>
			</form>
		</main>

		<footer><?php include 'footer.inc'; ?></footer>
	</body>
</html>