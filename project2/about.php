<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Group Project">
	<meta name="keywords" content="MemMis, GroupProject, About us, About Us">
	<meta name="author" content="Hoang Trong Toan, Toan Hoang">
	<link rel="stylesheet" href="styles/styles.css">
	<title>About Us | MemMis</title>
</head>

<body>
	<?php include 'header.inc'; $current_page='about.php'; include 'menu.inc'; ?>

	<main>
		<h1 id="about_h1">About Our Team</h1>

		<section id="group_info">
			<h2>Group Information</h2>
			<div id="divider">
				<ul>
					<li>Team: MemMis</li>
					<li>Class: COS10026 - Can Tho campus</li>
					<li>Schedule:
						<ul>
							<li>Tuesday, 9:00&ndash;11:00 (every week)</li>
							<li>13:00&ndash;15:00 (odd weeks only)</li>
						</ul>
					</li>
					<li>Lecturer: Mr. Trung Doan (Wilson)</li>
					<li id="student_id">Members student IDs:
						<ul>
							<li>Truc Nguyen&ndash;106217880</li>
							<li>Duy Tran&ndash;106216081</li>
							<li>Viet Do&ndash;106217932</li>
							<li>Khang Mai&ndash;106217893</li>
							<li>Toan Hoang&ndash;106217877</li>
						</ul>	
					</li>
				</ul>
			</div>
		</section>

		<section id="group_photo">
			<h2>MemMis Group Photo</h2>
			<figure>
				<img src="images/team.jpg"
						alt="MemMis project team during a lecture on campus">
				<figcaption>Photo taken on September 30th, 2025</figcaption>
			</figure>
		</section>

		<section id="contributions_and_demographics">
			<h2>Member Contributions and Demographics</h2>
			<dl>
				<dt>Truc Nguyen</dt>
				<dd class="flex_container">
					<div class="text_containter">
						Git support, CSS support, HTML support, Team lead	<!-- project 1 -->
						, HTML to PHP, Setting page design, enhancements	<!-- project 2 -->
						<ul>
							<li>Male</li>
							<li>Birthday: 02/04/2007</li>
							<li>Home town: Châu Đốc Ward (old Châu Đốc City), An Giang Province, Vietnam. Famous for its
								spiritual landmarks, including the sacred Bà Chúa Xứ Temple (Temple of the Holy Mother of
								the Realm ).</li>
						</ul>
					</div>	
					<figure>
						<img src="images/Truc.jpg" 
							 alt="Avatar chosen by Truc Nguyen">
						<figcaption>Truc Nguyen's avatar</figcaption>
					</figure>
				</dd>
			</dl>
			<dl>
				<dt>Duy Tran</dt>
				<dd class="flex_container">
					<div class="text_containter">
						Job description Page design
						, Database design <!-- I don't know what jobs description in database is so i'll just put this here and comeback later if there's any changes-->
						<ul>
							<li>Male</li>
							<li>Birthday: 01/01/2007</li>
							<li>Home town: Can Tho City-The largest city in the Mekong Delta, known as "Tây Đô"( the Western
								Metropolis ) with a history spanning over 270 years. This lovely city is famous for its
								people, food (Bánh xèo củ hủ dừa, bánh cống, vịt nấu chao,lẩu cá linh bông điên điển, etc.)
							</li>
						</ul>
					</div>	
					<figure>
						<img src="images/Duy.jpg" 
							 alt="Avatar chosen by Duy Tran">
						<figcaption>Duy Tran's avatar</figcaption>
					</figure>
				</dd>
			</dl>
			<dl>
				<dt>Viet Do</dt>
				<dd class="flex_container">
					<div class="text_containter">
						Job application Page design
						, Expression of Interest process
						<ul>
							<li>Male</li>
							<li>Birthday: 28/10/2007</li>
							<li>Home town: Can Tho is the fourth-largest city in Vietnam, and one of six Municipalities. Can
								Tho is known for its kind and modest people, and being a large city with less hustle and
								bustle compared to cities like Ho Chi Minh or Ha Noi.</li>
						</ul>
					</div>
					<figure>
						<img src="images/Viet.jpg" 
							 alt="Avatar chosen by Viet Do">
						<figcaption>Viet Do's avatar</figcaption>
					</figure>
				</dd>
			</dl>
			<dl>
				<dt>Khang Mai</dt>
				<dd class="flex_container">
					<div class="contributions">
						CSS design
						, Expression of Interest Table
						<ul>
							<li>Male</li>
							<li>Birthday: 08/02/2007</li>
							<li>Home town: Vinh Long, rich in alluvial soil and lots of waterway/river/canal networks.
								“Miệt vườn” style tourism (orchard gardens, floating markets). Some famous locations:An 
								Bình island & Bình Hòa Phước island, Van Thanh Temple, Van Xuong Shrine,...</li>
						</ul>
					</div>	
					<figure>
						<img src="images/Khang.png" 
							 alt="Avatar chosen by Khang Mai">
						<figcaption>Khang Mai's avatar</figcaption>
					</figure>
				</dd>
			</dl>
			<dl>
				<dt>Toan Hoang</dt>
				<dd class="flex_container">
					<div class="text_containter">
						About us Page design 
						& content update, Manage page design
						<ul>
							<li>Male</li>
							<li>Birthday: 14/02/2007</li>
							<li>Home town: Can Tho City, the major supplier of rice in Viet Nam, the heart of Mekong Delta.
								Famous for being the centre of culture, economic of the West with some unique attraction
								such as rice paper making village and floating market.</li>
						</ul>
					</div>
					<figure>
						<img src="images/Toan.jpg" 
							 alt="Avatar chosen by Toan Hoang">
						<figcaption>Toan Hoang's avatar</figcaption>
					</figure>
				</dd>
			</dl>
		</section>

		<section id="members_interests">
			<h2>What Our Members Enjoy</h2>
			<table>
				<caption>Members Interests</caption>
				<thead>
					<tr>
						<th>Name</th>
						<th>Categories</th>
						<th>Details</th>
					</tr>
				</thead>
				<tbody>
					<!-- The requirements for part 1 asks for multiple rowspan and colspan -->
					<tr>
						<td rowspan="2" class="member_name">Truc Nguyen</td>
						<td>Music & Media</td>
						<td>Pop music, Anime, Fantasy/Sci-fi novels</td>
					</tr>
					<tr>
						<td>Gaming</td>
						<td>Rhythm/Turn-based games</td>
					</tr>

					<tr>
						<td rowspan="3" class="member_name">Duy Tran</td>
						<td colspan="2">Photography</td>
					</tr>
					<tr>
						<td>Gaming</td>
						<td>Valorant and Minecraft</td>
					</tr>
					<tr>
						<td>Lifestyle</td>
						<td>Likes to stay busy (not too busy though)</td>
					</tr>

					<tr>
						<td rowspan="2" class="member_name">Viet Do</td>
						<td>Creative</td>
						<td>Art, Music, Coffee</td>
					</tr>
					<tr>
						<td>Activities</td>
						<td>Travelling, Figure skating</td>
					</tr>

					<tr>
						<td rowspan="2" class="member_name">Khang Mai</td>
						<td>Creative & Sports</td>
						<td>Music making, Art, Athlete</td>
					</tr>
					<tr>
						<td colspan="2">Gaming in general</td>
					</tr>

					<tr>
						<td rowspan="2" class="member_name">Toan Hoang</td>
						<td>Music & Media</td>
						<td>Pop music, Sci-fi movies, Manhwa, Manga</td>
					</tr>
					<tr>
						<td>Gaming</td>
						<td>League of Legend and simulator games</td>
					</tr>
				</tbody>
			</table>
		</section>
	</main>

	<footer><?php include 'footer.inc'; ?></footer>
</body>

</html>