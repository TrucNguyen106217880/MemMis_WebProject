<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Tran-Minh-Duy">
	<link rel="stylesheet" href="styles/styles.css">
	<title>Positions Description | MemMis</title>
</head>

<body>
	<?php include 'header.inc'; $current_page='jobs.php'; include 'menu.inc'; ?>

	<main id="jobs_page">
		<?php
			include_once ('settings.php');
						
			$sql="SELECT * FROM `jobs`";
			$result=mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo 
					"
					<article>
						<h1 id=\"".$row['reference_number']."\">".$row['job_name']." - ".$row['reference_number']."</h1>
						<aside>".$row['aside_info']."</aside>
	
						<section>
							<h2>About the role</h2>
							<p>".$row['about_the_role']."</p>
						</section>
						<section>
							<h2>Resposibility</h2>
							<p>".$row['responsibility']."</p>
						</section>
						<section>
							<h2>Required qualifications</h2>
							".list_breaks($row['required_qualifications'],false)."
						</section>
						<section>
							<h2>Nice-to-have qualifications</h2>
							".list_breaks($row['nice_to_have_qualifications'],false)."
						</section>
						<section>
							<h2>Salary and benefits</h2>
							".list_breaks($row['salary_and_benefits'],false)."
						</section>
					</article>
					";
				}
			}
			else {
				echo "
				<h1>Positions unavailable</h1>
				<p>We will update this with available positions when they are open. Thank you for your support</p>";
			}

			function list_breaks($text, $ordered=false) {
				$lines=explode("\n", $text);
				$lines=array_filter(array_map('trim', $lines));
				$type=$ordered?'ol':'ul';

				$res="<$type>\n";
				foreach ($lines as $line) {
					$res.="<li>".htmlspecialchars($line)."</li>\n";
				}
				$res.="</$type>";

				return $res;
			}
		?>
	</main>

	<footer><?php include 'footer.inc'; ?></footer>
</body>

</html>