<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Viet Do">
	<link rel="stylesheet" href="styles/styles.css">
	<title>Job Application | MemMis</title>
</head>

<body>
	<?php include 'header.inc'; $current_page='apply.php'; include 'menu.inc'; ?>

	<main>
		<h1 id="header_Application">Application</h1>
		<!-- Form for applicants to enter application information -->
		<!-- All IDs are named following the camelCase naming convention -->
		<form action="process_eoi.php" method="post">
			<!-- Drop down list to select job reference numbers -->
			<label for="jobReferenceNumber">Job reference number
			</label>
			<select id="jobReferenceNumber" name="referencenumber" required>
				<option value=""> Please select
					<!--This option only prompts the user to select and is not counted as a real option due to its empty string-->
				</option>
				<option>SO145
				</option>
				<option>AI313
				</option>
				<option> CY296
				</option>
			</select>

			<br>

			<!-- Text input section to enter first name -->
			<label for="firstName"> First name
			</label>
			<input type="text" id="firstName" name="firstname" required pattern="^[a-zA-Z]{1,20}$"
				   title="Max 20 alpha characters only"> <!--Max 20 alpha characters-->

			<br>

			<!-- Text input section to enter last name -->
			<label for="lastName"> Last name
			</label>
			<input type="text" id="lastName" name="lastname" required pattern="^[a-zA-Z]{1,20}$"
				   title="Max 20 alpha characters only"> <!--Max 20 alpha characters-->

			<br>

			<!-- Text input section to enter birth date -->
			<label for="dateOfBirth"> Date of birth
			</label>
			<input type="text" id="dateOfBirth" name="dateofbirth" required
				   pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/\d{4}$" placeholder="dd/mm/yyyy"
				   title="Please follow the dd/mm/yyyy format"> <!--Number 0-9 only, must follow dd/mm/yyyy format-->

			<!-- field to group gender selection section -->
			<fieldset>
				<legend>Gender
				</legend>

				<!-- Radio button section to choose gender -->
				<label for="male"> Male
				</label>
				<input type="radio" id="male" name="Gender" value="Male" required="required">

				<label for="feMale"> Female
				</label>
				<input type="radio" id="feMale" name="Gender" value="Female">
			</fieldset>

			<!--Text input section to enter street address  -->
			<label for="streetAddress"> Street address
			</label>
			<input type="text" id="streetAddress" name="Streetaddress" required pattern="^.{1,40}$"
				   title="Max 40 characters">
			<!--Max 40 any characters, I'm using ". because an address *may* contain special characters-->

			<br>

			<!-- "/" redacted from ID to avoid server-side processing issues -->
			<label for="suburbTown"> Suburb/town
			</label>
			<input type="text" id="suburbTown" name="Suburb/town" required pattern="^.{1,40}$"
				   title="Max 40 characters"> <!--Max 40 any characters-->

			<br>

			<!-- Dropdown list to choose a State -->
			<label for="state">State
			</label>
			<select id="state" name="State" required>
				<option value="">
					<!--This option only prompts the user to select a State and is not counted as a real option due to its empty string-->
					Please select a State
				</option>
				<option value="VIC">VIC
				</option>
				<option value="NSW">NSW
				</option>
				<option value="QLD">QLD
				</option>
				<option value="NT">NT
				</option>
				<option value="WA">WA
				</option>
				<option value="SA">SA
				</option>
				<option value="TAS">TAS
				</option>
				<option value="ACT">ACT
				</option>
			</select>

			<br>

			<!-- Text input section to enter post code -->
			<label for="postCode"> Postcode
			</label>
			<input type="text" id="postCode" name="Postcode" required pattern="^0[2-9][0-9]{2}|[1-9][0-9]{3}$"
				   maxlength="4" placeholder="0200-9999" title="Please choose within the range 0200-9999">

			<br>

			<!-- Input for email -->
			<label for="eMail">
				Email
			</label>
			<input type="email" id="eMail" name="Email" required>
			<!--Automatically validate email format without pattern attribute-->

			<!-- Text input section to enter phone number -->
			<label for="phoneNumber"> Phone number
			</label>
			<input type="text" id="phoneNumber" name="Phonenumber" required pattern="^[\d\s]{8,12}$"
				   title="8 to 12 space or digits only"> <!--Between 8 to 12 space or digits-->

			<br>

			<!-- checkbox section to select one or more required technical skills -->
			<fieldset>
				<legend>
					Required technical skills (Only pick skills belonging to your selected job)
				</legend>
				<fieldset>
					<legend>
						SO415
					</legend>
					<label for="skill1">Bachelor's Degree in Software Engineering or related field.
					</label>
					<input type="checkbox" id="skill1" name="SO415[]" value="skill 1" checked required>

					<label for="skill2">1+ years of software developing experience.
					</label>
					<input type="checkbox" id="skill2" name="SO415[]" value="skill 2">

					<label for="skill3">Familiarity with Agile development methodology.
					</label>
					<input type="checkbox" id="skill3" name="SO415[]" value="skill 3">

					<label for="skill4">Ability to define and solve logical problems for highly technical applications.
					</label>
					<input type="checkbox" id="skill4" name="SO415[]" value="skill 4">

					<label for="skill5">Proven experience in software development (e.g., internships, projects, or
						professional roles).
					</label>
					<input type="checkbox" id="skill5" name="SO415[]" value="skill 5">

					<label for="skill6">Proficiency in one or more programming languages (e.g., Java, Python, C#,
						JavaScript).
					</label>
					<input type="checkbox" id="skill6" name="SO415[]" value="skill 6">

					<label for="skill7">Attention to details.
					</label>
					<input type="checkbox" id="skill7" name="SO415[]" value="skill 7">

					<label for="skill8">Excellent communication skill.
					</label>
					<input type="checkbox" id="skill8" name="SO415[]" value="skill 8">

					<label for="skill9">Keep up to date with new technology
					</label>
					<input type="checkbox" id="skill9" name="SO415[]" value="skill 9">

				</fieldset>
				<fieldset>
					<legend>
						AI313
					</legend>
					<label for="skill10">Bachelor's or Master's degree in Computer Science, Artificial Intelligence,
						Data Science, or related field.
					</label>
					<input type="checkbox" id="skill10" name="AI313[]" value="skill 10" checked>

					<label for="skill11">1+ years of experience as an AI engineer.
					</label>
					<input type="checkbox" id="skill11" name="AI313[]" value="skill 11">

					<label for="skill12">Strong programming skills in Python and experience with ML libraries such as
						TensorFlow, PyTorch,
						Scikit-learn.
					</label>
					<input type="checkbox" id="skill12" name="AI313[]" value="skill 12">

					<label for="skill13">Familiarity with cloud platforms (e.g., AWS, Azure, GCP) and containerization
						tools (e.g., Docker,
						Kubernetes).
					</label>
					<input type="checkbox" id="skill13" name="AI313[]" value="skill 13">

					<label for="skill14">Experience with data preprocessing, feature engineering, and model evaluation.
					</label>
					<input type="checkbox" id="skill14" name="AI313[]" value="skill 14">

					<label for="skill15">Familarity with Agile development method
					</label>
					<input type="checkbox" id="skill15" name="AI313[]" value="skill 15">

					<label for="skill16">Attention to details.
					</label>
					<input type="checkbox" id="skill16" name="AI313[]" value="skill 16">

					<label for="skill17">Keep up to date with new technology
					</label>
					<input type="checkbox" id="skill17" name="AI313[]" value="skill 17">

				</fieldset>
				<fieldset>
					<legend>
						CY296
					</legend>

					<label for="skill18">Bachelor's or Master's degree in cybersecurity or related field.
					</label>
					<input type="checkbox" id="skill18" name="CY296[]" value="skill 18" checked>

					<label for="skill19">2+ years of experience in cybersecurity or IT security roles
					</label>
					<input type="checkbox" id="skill19" name="CY296[]" value="skill 19">

					<label for="skill20">Knowledge of security frameworks and standards (e.g., NIST, ISO 27001, CIS).
					</label>
					<input type="checkbox" id="skill20" name="CY296[]" value="skill 20">

					<label for="skill21">Strong understanding of network protocols, operating systems, and security
						tools.
					</label>
					<input type="checkbox" id="skill21" name="CY296[]" value="skill 21">

					<label for="skill22">Able to work both independently and on a team.
					</label>
					<input type="checkbox" id="skill22" name="CY296[]" value="skill 22">

				</fieldset>
			</fieldset>

			<br>

			<!-- Large text area to enter other skils -->
			<label for="otherSkills"> Other skills
			</label>
			<br>
			<textarea id="otherSkills" name="Otherskills" rows="4" cols="30" placeholder="Enter other skills here...">
		</textarea>

			<br>

			<input type="submit" value="Apply">
		</form>
	</main>

	<footer><?php include 'footer.inc'; ?></footer>
</body>

</html>