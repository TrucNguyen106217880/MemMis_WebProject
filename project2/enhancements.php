<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Truc Nguyen 106217880">
		<link rel="stylesheet" href="styles/styles.css">
		<title>Enhancements logs</title>
	</head>
	<body>
		<?php include 'header.inc'; $current_page='index.php'; include 'menu.inc'; ?>

		<main>
			<dl id="enhancements_list">
				<dt>Create a manager registration page with server side validation requiring unique 
					username and a password rule, and store this information in a table. </dt>
				<dd>When the user is on the login page (login.php), there will be an option to register
					a new account (move the user to register.php).<br>
					A simple password check is done to ensure it is at least 8 characters long with at least one uppercase,
					one lowercase and one number; along with a confirm password input. If any requirement is not met, an 
					corresponding error message will be displayed.<br>
					<div class="notification_error">
						<ul>
							<li>Password and confirmation do not match.</li>
							<li>Password must be at least 8 characters.</li>
							<li>Password must contain at least one uppercase letter.</li>
							<li>Password must contain at least one number.</li>					
						</ul>
					</div>
					The maximum amount of manager account available is 2. If there are already 2 or more 
					accounts, an error will be displayed and the user will be asked to login instead.<br>
					<div class="notification_error">
						<?= $limit="<p>Registration limit reached. Only 2 manager accounts are allowed.</p>" ?>
						<?= "<p>Please <a href='login.php' class='internal_link'>login</a></p>" ?>
					</div>
				</dd>
				<dt>Control access to manage.php by checking username and password.</dt>
				<dd>After logging in successfully, a the session user_id will be recorded.<br>
					Login.php and manage.php will check for this user_id: <br>
					<ul>
						<li>If it is NOT empty:
							<ul>
								<li>Login.php will display an error message and ask the user to either logout or
									go to management page.</li>
								<div class='notification_error'>
									<p>You are currently logged in. <a href='logout.php' class='internal_link'>Log out?</a></p>
									<p><a href='manage.php' class='internal_link'>Go to Management page</a></p>
								</div>
								<li>Manage.php will display the user's username along with the option to log out
									on the top of the page.</li>
								<div class="notification_success">
									<p>Welcome, exampleuser. <a href="logout.php" class="internal_link">Log out?</a></p>
								</div>
							</ul>
						</li>
						<li>If it is empty:
							<ul>
								<li>Login.php will display the username and password inputs as normal.</li>
								<li>Manage.php will immediately move the user to login.php.</li>
							</ul>
						</li>
					</ul>
				</dd>
				<dt>Have access to the web site disabled after three or more consecutive invalid login attempts.</dt>
				<dd>A failed_attempts count will be record for each account.<br>
					The count will be increased by 1 after each invalid login attempt. <br>
					The account will be login locked for 30 minutes if failed_attempts >= 3.<br>
					<div class='notification_error'>
						<p>Too many failed attempts. Account locked for 30 minutes.</p>
					</div>
					The login failure count will only be reset (failed_attempts = 0) after a successful login of that account.<br>
				</dd>
				<dt>Provide the manager with the ability to select the field on which to sort the order in
					which the EOI records are displayed.</dt>
				<dd>Using the same method that method="get" would do for forms, an anchor tag is used with modified href endings
					through the header_link() function, which identify the field that is chosen to be sorted.<br>
					By default, eoi_number will be sorted in ascending if no specific field is chosen for sorting.
				</dd>
			</dl>
		</main>

		<footer><?php include 'footer.inc'; ?></footer>
	</body>
</html>