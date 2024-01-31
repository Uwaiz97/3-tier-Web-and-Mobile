<?php
session_start();

include "classes/application-view.classes.php";
include "classes/student-view.classes.php";

$userid = $_SESSION["userId"];

$application = new ApplicationView();
$properties = $application->showProperty($userid);

$studentView = new StudentView();
$landlordProps = $studentView->showLandlordPropeties($_SESSION["userId"]);
$queries = array();
//$queries[] = 5;
foreach ($landlordProps as $lp) {
	$queries[] = $studentView->showUnresolvedQueries($lp["prop_id"]);
}


$resultProp = array();
foreach ($properties as $property) {
	if ($property["prop_accreditStatus"] == "Accredited") {
		$resultProp[] = $property;
	}
}
?>


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
	<style>
		.notification {
			background-color: #ff6b6b;
			/* Background color of the notification */
			color: #fff;
			/* Text color */
			padding: 10px 20px;
			/* Spacing inside the notification bar */
			position: fixed;
			/* Fixed position at the top */
			top: 0;
			/* Stick to the top of the viewport */
			width: 100%;
			/* Full width */
			text-align: center;
			/* Center-align text */
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			/* Add a subtle shadow for depth */
			z-index: 9999;
			/* Ensure the notification appears above other content */
		}

		.notification a {
			color: #fff;
			/* Link color within the notification */
			text-decoration: underline;
			/* Add underline to links */
		}

		.notification a:hover {
			text-decoration: none;
			/* Remove underline on hover */
		}
	</style>
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

			<ul>
				<li>
					<a href="#" class="dropdown-toggle">Accreditation</a>

					<ul>
						<li><a href="applicationPage.php">Apply for Accreditation</a></li>
						<li><a href="viewApplicationStatusPage.php">View Accreditation Status</a></li>
					</ul>
				</li>

				<?php if (!empty($resultProp)) { ?>
					<li>
						<a href="#" class="dropdown-toggle">Students</a>

						<ul>
							<li><a href="confirmStudentPage.php">Confirm Students</a></li>
							<li><a href="maintenanceIssues.php">View Maintenance Issues</a></li>
							<li><a href="reportPage.php">Report Student</a></li>
						</ul>
					</li>
					<!-- <li><a href="registerCaretaker.php">Register Caretaker</a></li> -->
				<?php } ?>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">
			<div class="notification">
				<?php if ($queries != null) {
					echo "You have unresolved maintenance queries";
				} ?>
			</div>
			<div class="inner">
				<header id="inner">
					<br>
					<h2>Landlord Home </h2>
				</header>



				<?php if (!empty($resultProp)) { ?>
					<section class="tiles">
						<article class="style1">
							<span class="image">
								<img src="images/application.png" alt="" height="350" />
							</span>

							<a href="applicationPage.php">
								<h2> Apply for Accreditation</h2>
							</a>
						</article>

						<article class="style2">
							<span class="image">
								<img src="images/status.png" alt="" height="350" />
							</span>

							<a href="viewApplicationStatusPage.php">
								<h2> View Application Status</h2>
							</a>
						</article>

						<article class="style3">
							<span class="image">
								<img src="images/confirm.png" alt="" height="350" />
							</span>

							<a href="confirmStudentPage.php">
								<h2> Confirm Students</h2>
							</a>
						</article>

						<article class="style4">
							<span class="image">
								<img src="images/query.png" alt="" height="350" />
							</span>

							<a href="maintenanceIssues.php">
								<h2>Maintenance Issues</h2>
							</a>
						</article>

						<article class="style5">
							<span class="image">
								<img src="images/report.png" alt="" height="350" />
							</span>

							<a href="reportPage.php">
								<h2>Report Student</h2>
							</a>
						</article>
					</section>
				<?php } else { ?>
					<section class="tiles">
						<article class="style1">
							<span class="image">
								<img src="images/application.png" alt="" height="350" />
							</span>

							<a href="applicationPage.php">
								<h2> Apply for Accreditation</h2>
							</a>
						</article>

						<article class="style2">
							<span class="image">
								<img src="images/status.png" alt="" height="350" />
							</span>

							<a href="viewApplicationStatusPage.php">
								<h2> View Application Status</h2>
							</a>
						</article>
					</section>

				<?php } ?>

			</div>
		</div>

		<!-- Footer -->
		<?php include 'footer.php'; ?>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/main.js"></script>

</body>

</html>