<?php
	$conn = require_once __DIR__ . '/settings.php';
	session_start();

	$errors = [];

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

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$username = trim($_POST['username'] ?? '');
		$password = $_POST['password'] ?? '';

		if ($username === '' || $password === '') {
			$errors[] = 'Enter username and password.';
		} 
		else {
			$stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$user = $result->fetch_assoc();

			if (!$user) {
				// avoid revealing whether username exists to help security, still we update nothing
				$errors[] = 'Invalid credentials.';
			} 
			else {
				if (!empty($user['lockout_until'])?strtotime($user['lockout_until']) > time():false) {
					$errors[] = 'Account locked. Please try again later.';
				} 
				else {
					if (password_verify($password, $user['password_hash'])) {
						// Successful login: reset failed attempts
						$update = $conn->prepare('UPDATE users SET failed_attempts = 0, lockout_until = NULL WHERE id = ?');
						$update->bind_param('i', $user['id']);
						$update->execute();
						$update->close();

						// Log user in
						$_SESSION['user_id'] = $user['id'];
						$_SESSION['username'] = $user['username'];

						header('Location: manage.php');
						exit;
					} 
					else {
						// Failed login: increment total failed attempts counter
						$failed = $user['failed_attempts'] + 1;
						$lockout_until = null;
						$max_failures = 3;
						$lockout_minutes = 30;

						if ($failed >= $max_failures) {
							$lockout_until = date('Y-m-d H:i:s', time() + ($lockout_minutes * 60));
							$errors[] = "Too many failed attempts. Account locked for {$lockout_minutes} minutes.";
						} 
						else {
							$errors[] = 'Invalid credentials.';
						}

						$upd = $conn->prepare('UPDATE users SET failed_attempts = ?, lockout_until = ? WHERE id = ?');
						$upd->bind_param('isi', $failed, $lockout_until, $user['id']);
						$upd->execute();
						$upd->close();
					}
				}
			}
			$stmt->close();
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
		<title>Manager Login</title>
	</head>
	<body>
		<?php include 'header.inc'; $current_page='register.php'; include 'menu.inc'; ?>			

		<main id="manager_pages">
			<?php
				if (!empty($_SESSION['user_id'])) {
					echo "<div class='notification_error'>";
					echo "You are currently logged in. <a href='logout.php' class='internal_link'>Log out?</a>";
					echo "</div>";
					exit;
				}
			?>

			<?php if ($errors): ?>
				<div class="notification_error">
					<ul>
						<?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
					</ul>
				</div>
			<?php endif; ?>

			<form method="post" action="">
				<label>Username</label>
				<input type="text" name="username" required>
				<br>
				<label>Password</label>
				<input type="password" name="password" required>
				<br>
				<input type="submit" value="Login"></input>
			</form>
			<p>Don't have an account? <a href="register.php" class="internal_link">Register</a></p>
		</main>

		<footer><?php include 'footer.inc'; ?></footer>
	</body>
</html>