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
		<h1 id="apply_h1">Application</h1>
		<!-- Form for applicants to enter application information -->
		<form action="process_eoi.php" method="post" id="apply_form" novalidate>
			<!-- Drop down list to select job reference numbers -->
			<label for="reference_number">Job reference number</label>
			<select id="reference_number" name="reference_number" required>
				<option value="">Please select</option>
				<option>SO145</option>
				<option>AI313</option>
				<option>CY296</option>
			</select>
			<br>

			<div id="name_grid">
				<div>
					<!-- Text input section to enter first name -->
					<label for="first_name">First name</label>
					<input type="text" id="first_name" name="first_name" required
						pattern="^[a-zA-Z]{1,20}$"
						title="Max 20 alpha characters only"> <!--Max 20 alpha characters-->
				</div>
				<div>
					<!-- Text input section to enter last name -->
					<label for="last_name">Last name</label>
					<input type="text" id="last_name" name="last_name" required 
						pattern="^[a-zA-Z]{1,20}$"
						title="Max 20 alpha characters only"> <!--Max 20 alpha characters-->
					<br>					
				</div>
			</div>
			
			<div id="dob_gender_grid">
				<div>
					<!-- Text input section to enter birth date -->
					<label for="date_of_birth">Date of birth</label>
					<input type="text" id="date_of_birth" name="date_of_birth" required
						   pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/\d{4}$" 
						   placeholder="dd/mm/yyyy"
						   title="Please follow the dd/mm/yyyy format"> <!--Number 0-9 only, must follow dd/mm/yyyy format-->				
				</div>
					<!-- Field to group gender selection section -->
				<fieldset>
					<legend>Gender</legend>
					<!-- Radio button section to choose gender -->
					<input type="radio" id="male" name="gender" value="male" required>
					<label for="male">Male</label>
					<input type="radio" id="female" name="gender" value="female">
					<label for="female">Female</label>
				</fieldset>
			</div>

			<!--Text input section to enter street address  -->
			<label for="street_address">Street address</label>
			<input type="text" id="street_address" name="street_address" required 
				   pattern="^.{1,40}$"
				   title="Max 40 characters">
			<!--Max 40 any characters, I'm using ". because an address *may* contain special characters-->
			<br>

			<label for="suburb_town">Suburb/town</label>
			<input type="text" id="suburb_town" name="suburb_town" required 
				   pattern="^.{1,40}$"
				   title="Max 40 characters"> <!--Max 40 any characters-->
			<br>

			<div id="states_grid">
				<div>
					<!-- Dropdown list to choose a State -->
					<label for="state">State</label>
					<select id="state" name="state" required>
						<option value="">Please select a State</option>
						<option value="NSW">NSW</option>
						<option value="ACT">ACT</option>
						<option value="VIC">VIC</option>
						<option value="QLD">QLD</option>
						<option value="SA">SA</option>
						<option value="WA">WA</option>
						<option value="TAS">TAS</option>
						<option value="NT">NT</option>
					</select>
				</div>
				<div>
					<!-- Text input section to enter postcode -->
					<label for="postcode">Postcode</label>
					<input type="text" id="postcode" name="postcode" required 
						pattern="^0[2-9][0-9]{2}|[1-9][0-9]{3}$"
						maxlength="4"
						title="Please choose within the state range">						
				</div>
			</div>
			<table class="table_styles">
				<thead>
					<th>State/Territory abbreviation</th>
					<th>Postcode range</th>
				</thead>
				<tbody>
					<tr>
						<td class="row_header">NSW</td>
						<td>1000&ndash;1999, 2000&ndash;2599, 2619&ndash;2899, 2921&ndash;2999</td>
					</tr>
					<tr>
						<td class="row_header">ACT</td>
						<td>0200&ndash;0299, 2600&ndash;2618, 2900&ndash;2920</td>
					</tr>
					<tr>
						<td class="row_header">VIC</td>
						<td>3000&ndash;3996, 8000&ndash;8999</td>
					</tr>
					<tr>
						<td class="row_header">QLD</td>
						<td>4000&ndash;4999, 9000&ndash;9999</td>
					</tr>
					<tr>
						<td class="row_header">SA</td>
						<td>5000&ndash;5799, 5800&ndash;5999</td>
					</tr>
					<tr>
						<td class="row_header">WA</td>
						<td>6000&ndash;6797, 6800&ndash;6999</td>
					</tr>
					<tr>
						<td class="row_header">TAS</td>
						<td>7000&ndash;7799, 7800&ndash;7999</td>
					</tr>
					<tr>
						<td class="row_header">NT</td>
						<td>0800&ndash;0899, 0900&ndash;0999</td>
					</tr>
				</tbody>
			</table>
			<br>

			<!-- Input for email -->
			<label for="email">Email</label>
			<input type="email" id="email" name="email" required>
			<!--Automatically validate email format without pattern attribute-->
			<br>

			<!-- Text input section to enter phone number -->
			<label for="phone_number">Phone number</label>
			<input type="text" id="phone_number" name="phone_number" required 
				   pattern="^[\d\s]{8,12}$"
				   title="8 to 12 space or digits only"> <!--Between 8 to 12 space or digits-->
			<br>

			<!-- checkbox section to select one or more required technical skills -->
			<fieldset>
				<legend>Required technical skills (Only pick skills belonging to your selected job)</legend>
				<fieldset class="inputs_group">
					<legend>SO415</legend>
					<span>
						<input type="checkbox" id="skill_1" name="SO145[]" value="skill_1" checked required>
						<label for="skill_1">Bachelor's Degree in Software Engineering or related field.</label>
					</span>
					<span>
						<input type="checkbox" id="skill_2" name="SO145[]" value="skill_2">
						<label for="skill_2">1+ years of software developing experience.</label>
					</span>
					<span>
						<input type="checkbox" id="skill_3" name="SO145[]" value="skill_3">
						<label for="skill_3">Familiarity with Agile development methodology.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_4" name="SO145[]" value="skill_4">
						<label for="skill_4">Ability to define and solve logical problems for highly technical applications.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_5" name="SO145[]" value="skill_5">
						<label for="skill_5">Proven experience in software development (e.g., internships, projects, or professional roles).</label>
					</span>
					<span>
						<input type="checkbox" id="skill_6" name="SO145[]" value="skill_6">
						<label for="skill_6">Proficiency in one or more programming languages (e.g., Java, Python, C#, JavaScript).</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_7" name="SO145[]" value="skill_7">
						<label for="skill_7">Attention to details.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_8" name="SO145[]" value="skill_8">
						<label for="skill_8">Excellent communication skill.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_9" name="SO145[]" value="skill_9">
						<label for="skill_9">Keep up to date with new technology</label>						
					</span>
				</fieldset>
				<fieldset class="inputs_group">
					<legend>AI313</legend>
					<span>
						<input type="checkbox" id="skill_10" name="AI313[]" value="skill_10" checked>
						<label for="skill_10">Bachelor's or Master's degree in Computer Science, Artificial Intelligence, Data Science, or related field.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_11" name="AI313[]" value="skill_11">
						<label for="skill_11">1+ years of experience as an AI engineer.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_12" name="AI313[]" value="skill_12">
						<label for="skill_12">Strong programming skills in Python and experience with ML libraries such as TensorFlow, PyTorch, Scikit-learn.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_13" name="AI313[]" value="skill_13">
						<label for="skill_13">Familiarity with cloud platforms (e.g., AWS, Azure, GCP) and containerization tools (e.g., Docker, Kubernetes).</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_14" name="AI313[]" value="skill_14">
						<label for="skill_14">Experience with data preprocessing, feature engineering, and model evaluation.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_15" name="AI313[]" value="skill_15">
						<label for="skill_15">Familarity with Agile development method</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_16" name="AI313[]" value="skill_16">
						<label for="skill_16">Attention to details.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_17" name="AI313[]" value="skill_17">
						<label for="skill_17">Keep up to date with new technology</label>						
					</span>
				</fieldset>
				<fieldset class="inputs_group">
					<legend>CY296</legend>
					<span>
						<input type="checkbox" id="skill_18" name="CY296[]" value="skill_18" checked>
						<label for="skill_18">Bachelor's or Master's degree in cybersecurity or related field.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_19" name="CY296[]" value="skill_19">
						<label for="skill_19">2+ years of experience in cybersecurity or IT security roles.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_20" name="CY296[]" value="skill_20">
						<label for="skill_20">Knowledge of security frameworks and standards (e.g., NIST, ISO 27001, CIS).</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_21" name="CY296[]" value="skill_21">
						<label for="skill_21">Strong understanding of network protocols, operating systems, and security tools.</label>						
					</span>
					<span>
						<input type="checkbox" id="skill_22" name="CY296[]" value="skill_22">
						<label for="skill_22">Able to work both independently and on a team.</label>						
					</span>
				</fieldset>
			</fieldset>

			<!-- Large text area to enter other skils -->
			<label for="other_skills">Other skills</label>
			<br>
			<textarea id="other_skills" name="other_skills" rows="4" cols="30" 
					  placeholder="Enter other skills here..."></textarea>
			<br>

			<input type="submit" value="Apply" id="submit_button">
		</form>
	</main>

	<footer><?php include 'footer.inc'; ?></footer>
</body>

</html>