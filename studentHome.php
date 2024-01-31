<!DOCTYPE HTML>
<html>
<?php
//include 'Partials\Connect.php';
?>

<head>
	<title>Student home page</title>
	<link
		href="https://upload.wikimedia.org/wikipedia/en/thumb/a/af/University_of_Johannesburg_Logo.svg/1200px-University_of_Johannesburg_Logo.svg.png"
		rel="icon">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-preload">
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<div class="inner">

				<!-- Logo -->
				<a href="index.html" class="logo">
					<span class="fa fa-home"></span> <span class="title">Welcome to Student portal</span>
				</a>

				<!-- Nav -->
				<nav>
					<ul>
						<li><a href="#menu">Menu</a></li>
					</ul>
				</nav>

			</div>
		</header>

		<!-- Menu -->
		<nav id="menu">
			<h2>Menu</h2>
			<ul>
				<li><a href="StudentHome.php">Menu</a></li>

				<li><a href="Login.php">Login</a></li>
				<li><a href="Register.php">Register</a></li>

				<li>
					<a href="#" class="dropdown-toggle">About</a>

					<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="team.html">Team</a></li>
						<li><a href="testimonials.html">Testimonials</a></li>
						<li><a href="terms.html">Terms</a></li>
					</ul>
				</li>
				<li><a href="contact.html">Contact Us</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

				<div class="inner">
					<!-- About Us -->
					<header id="inner">
						<!--<h1>You want to apply for accreditation?, we got you</h1>--->
						<!---<p>Etiam quis viverra lorem, in semper lorem. Sed nisl arcu euismod sit amet nisi euismod sed cursus arcu elementum ipsum arcu vivamus quis venenatis orci lorem ipsum et magna feugiat veroeros aliquam. Lorem ipsum dolor sit amet nullam dolore.</p>---->
					</header>

					<br>

					<h3 class="h3">Student Accommodation Details</h3>

					<!-- Vacations -->
					<section class="tiles">
						<article class="style1">
							<span class="image">
								<img src="images/City.jpeg" alt="" />
							</span>
							<a href="Login.php">

								<h2>SouthPoint Student Accommodation</h2>

								<p>************************************</p>

								<p>
									Cnr De Korte St &, Biccard St &nbsp;|&nbsp; 011 489 1900 &nbsp;|&nbsp; 100 sq m
									&nbsp;|&nbsp; 2010 <br>

									<i class="fa fa-bed"></i> Single rooms &nbsp;|&nbsp;
									<i class="fa fa-bed"></i> Sharing rooms
								</p>
							</a>
						</article>
						<article class="style2">
							<span class="image">
								<img src="images/SouthPoint.jpeg" alt="" />
							</span>
							<a href="Login.php">
								<h2>City Waldorf Student Accommodation</h2>

								<p>************************************</p>

								<p>
									House &nbsp;|&nbsp; For Sale &nbsp;|&nbsp; 100 sq m &nbsp;|&nbsp; 2010 <br>

									<i class="fa fa-bed"></i> Bedrooms: 4 &nbsp;|&nbsp;
									<i class="fa fa-tint"></i> Bathrooms: 4
								</p>
							</a>
						</article>
						<article class="style3">
							<span class="image">
								<img src="images/Gateway.jpeg" alt="" />
							</span>
							<a>
								<h2>Gateway Student Accommodation</h2>

								<p>************************************</p>

								<p>
									House &nbsp;|&nbsp; For Sale &nbsp;|&nbsp; 100 sq m &nbsp;|&nbsp; 2010 <br>

									<i class="fa fa-bed"></i> Bedrooms: 4 &nbsp;|&nbsp;
									<i class="fa fa-tint"></i> Bathrooms: 4
								</p>
							</a>
						</article>

						<article class="style4">
							<span class="image">
								<img src="images/Res.jpeg" alt="" />
							</span>
							<a href="Login.php">
								<h2>The Richmond Student Accommodation</h2>

								<p>************************************</p>

								<p>
									House &nbsp;|&nbsp; For Sale &nbsp;|&nbsp; 100 sq m &nbsp;|&nbsp; 2010 <br>

									<i class="fa fa-bed"></i> Bedrooms: 4 &nbsp;|&nbsp;
									<i class="fa fa-tint"></i> Bathrooms: 4
								</p>
							</a>
						</article>

						<article class="style5">
							<span class="image">
								<img src="images/Res2.jpeg" alt="" />
							</span>
							<a href="Login.php">
								<h2>Campus Central Student Accommodation</h2>

								<p>************************************</p>

								<p>

									House &nbsp;|&nbsp; For Sale &nbsp;|&nbsp; 100 sq m &nbsp;|&nbsp; 2010 <br>

									<i class="fa fa-bed"></i> Bedrooms: 4 &nbsp;|&nbsp;
									<i class="fa fa-tint"></i> Bathrooms: 4

								</p>
							</a>
						</article>

						<article class="style6">
							<span class="image">
								<img src="images/Campus.jpeg" alt="" />
							</span>
							<a href="Login.php">
								<h2>The Campus Student Accommodation</h2>

								<p>************************************</p>

								<p>

									House &nbsp;|&nbsp; For Sale &nbsp;|&nbsp; 100 sq m &nbsp;|&nbsp; 2010 <br>

									<i class="fa fa-bed"></i> Bedrooms: 4 &nbsp;|&nbsp;
									<i class="fa fa-tint"></i> Bathrooms: 4

								</p>
							</a>
						</article>
					</section>


				</div>
			</div>

			<!-- Footer -->
			<?php include 'footer.php'; ?>

		</div>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/main.js"></script>

</body>

</html>