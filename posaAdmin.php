<!DOCTYPE HTML>
<html>

<head>

	<link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="icon">
	<link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="apple-touch-icon">
	<title>Home Page</title>
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
				<li><a href="applicationHandler.php">View Applications</a></li>
				<li><a href="viewAccommodation.php">View Accommodations</a></li>
				<li><a href="inspectedList.php">View Completed Inspections</a></li>
				<li><a href="escalated.php">View Escalated Issues</a></li>
				<li><a href="adminReports.php">View Reported Issues</a></li>
				<li><a href="stats.php">Stats</a></li>
				<li><a href="registerEmployee.php">Register Staff Member</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">
			
			<div class="inner">
			<header id="inner">
				<h1 >Admin Home </h1>
                </header>
				<section class="tiles">
					<article class="style1">
						<span class="image">
							<img src="images/application.png" alt="" height="350" />
						</span>

						<a href="applicationHandler.php">
							<h2> Applications</h2>
						</a>
					</article>
					<article class="style2">
						<span class="image">
							<img src="images/inspection.png" alt="" height="350"/>
						</span>

						<a href="inspectedList.php">
							<h2> Inspections</h2>
						</a>
					</article>

					<article class="style3">
						<span class="image">
							<img src="images/query.png" alt="" height="350" />
						</span>

						<a href="escalated.php">
							<h2>Escalated Queries</h2>
						</a>
					</article>

					<article class="style4">
						<span class="image">
							<img src="images/report.png" alt="" height="350"/>
						</span>

						<a href="adminReports.php">
							<h2>reported Issues</h2>
						</a>
					</article>

					<article class="style5">
						<span class="image">
							<img src="images/stats.png" alt="" height="350"/>
						</span>

						<a href="stats.php">
							<h2>Statistics</h2>
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