<?php
	$conn = require_once __DIR__ . '/settings.php';
	session_start();

	$errors = [];
	$success = '';
	
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
				$success = 'Registration successful.';
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

		<main>
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
				<label>Username</label>
				<input type="text" name="username" value="<?=htmlspecialchars($username ?? '')?>" required>
				<br>
				<label>Password</label>
				<input type="password" name="password" required>
				<br>
				<label>Confirm Password</label>
				<input type="password" name="confirm" required>
				<br>
				<input type="submit" value="Register"></input>
			</form>
		</main>

		<footer><?php include 'footer.inc'; ?></footer>
	</body>
</html>