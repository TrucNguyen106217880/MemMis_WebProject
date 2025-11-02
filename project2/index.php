<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description"
		  content="We build custom websites for businesses. Our team provides end-to-end development, scalable solutions with user-friendly design; helping you turn your idea into a successful website.">
	<meta name="keywords" content="custom website, website development, end-to-end website development">
	<meta name="author" content="Truc Nguyen 106217880">
	<link rel="stylesheet" href="styles/styles.css">
	<title>Custom Website Design & Development | MemMis</title>
</head>

<body>
	<?php include 'header.inc'; $current_page='index.php'; include 'menu.inc'; ?>

	<main>
		<!-- CSS: Call to action button, visual banner -->
		<section id="welcome">
			<h1>Welcome to MemMis</h1>
			<h2>Custom Websites. Scalable Solutions. Seamless Design.</h2>
			<p>At MemMis, we believe every business deserves a website that is as unique as its vision. Founded by five
				passionate creators, we specialize in building custom websites that combine powerful technology with
				intuitive
				design.
			</p>
			<p>Whether you're launching a startup or scaling an enterprise, we deliver end-to-end development, scalable
				architecture, and user-friendly interfaces that grow with you.
			</p>
			<!-- Call to action -->
			<button onclick="window.location.href='#contact'">Start your project now!</button>
		</section>

		<section id="differentiators">
			<h3>What Sets Us Apart</h3>
			<ul>
				<li>Tailored Development&mdash;No templates. Just handcrafted solutions built around your goals.</li>
				<li>Full-Service Approach&mdash;From idea to deployment, we handle every step with care.</li>
				<li>Scalability First&mdash;Our systems evolve with your business, ensuring long-term performance.</li>
				<li>Design That Works&mdash;Clean, accessible, and built for real users.</li>
			</ul>
		</section>

		<section id="information">
			<h3>Built by People Who Care</h3>
			<p>MemMis was founded by a team who share a love for great design, clean code, and solving real problems.
				We are agile, collaborative, and obsessed with quality.</p>
			<a href="about.php" class="internal_link">Know more about us!</a>
		</section>

		<section id="projects">
			<h3>Our proud creations</h3>
			<a href="https://talkforeco.clearlyfake.com" class="external_link">TalkForEco</a>
			<p>A place environmentalists gather for a greater cause. The website helps them gather volunteers, raise
				funds, discover spectacular ideas from minds alike for a greener future.</p>
			<p>"MemMis transformed our online presence. It was incredible working with them!&mdash;Leaf Erikson, Founder
				of TalkForEco"</p>

			<a href="https://bettersaveelec.fakeproject.com" class="external_link">BetterSaveElec</a>
			<p>Tired of wasted watts and unpredictable surges? BetterSaveElec uses AI-powered forecasting to optimize
				energy distribution. Clean and efficient</p>
			<p>"Fast, crative, reliable. Working with MemMis was the best decision we made ever!"&mdash;Solarina Spark,
				CEO of BetterSaveElec</p>
		</section>

		<section id="services">
			<h3>What we offer</h3>
			<ul>
				<li>Core web function development</li>
				<li>UX/UI design</li>
				<li>Backend architecture</li>
				<li>Continuance maintenence & Support</li>
				<li>Custom solutions & More</li>
			</ul>
		</section>

		<section id="hiring">
			<h3>Join the Team</h3>
			<p>We're growing — and we're looking for passionate developers, designers, and creative thinkers to join us.
				If you're excited about building meaningful digital experiences, we'd love to hear from you.</p>
			<!-- Call to action -->
			<button onclick="window.location.href='jobs.php'">See open positions</button>
		</section>

		<section id="contact">
			<h3>Let’s Build Something Great</h3>
			<p>Ready to turn your ideas into reality? Reach out and let’s talk.</p>
			<a href="mailto:info@MemMis.com.au" class="external_link">Email us</a>
		</section>
	</main>

	<footer><?php include 'footer.inc'; ?></footer>
</body>

</html>