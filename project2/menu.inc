		<nav>
			<label for="menu_toggle" id="menu_toggle_text" title="Toggle menu">☰ Menu</label>
			<ul class="menu">
				<li><a href="index.php"<?php echo ($current_page=='index.php')?' class="active"':''?>>Home</a></li>
				<li><a href="jobs.php"<?php echo ($current_page=='jobs.php')?' class="active"':''?>>Job Positions</a>
					<ul class="joblist">
						<li><a href="jobs.php#SO145">Software Developer - SO145</a></li>
						<li><a href="jobs.php#AI313">AI Engineer - AI313</a></li>
						<li><a href="jobs.php#CY296">Cybersecurity Specialist - CY296</a></li>
					</ul>
				</li>
				<li><a href="apply.php"<?php echo ($current_page=='apply.php')?' class="active"':''?>>Application</a></li>
				<li><a href="about.php"<?php echo ($current_page=='about.php')?' class="active"':''?>>About Us</a></li>
				<li><a href="mailto:info@MemMis.com.au">Email: info@MemMis.com.au</a></li>
			</ul>
		</nav>
	</header>
