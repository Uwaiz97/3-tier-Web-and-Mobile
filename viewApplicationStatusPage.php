<?php
session_start();

include "classes/application-view.classes.php";

$userid = $_SESSION["userId"];

$application = new ApplicationView();
$properties = $application->showProperty($userid);

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
	<title>View Applications Status</title>
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
	<style>
		th {
			cursor: pointer;
		}
	</style>
</head>

<body class="is-preload">
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<div class="inner">

				<!-- Logo -->
				<a href="landlordHome.php" class="logo">
					<span class="fa fa-home"></span> <span class="title">POSA</span>
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

			<br>
			<br>

			<div class="inner">

				<h2 class="h2">View Applications Status</h2>

				<br>

				<table id="issueTable">
					<thead>
						<tr>
							<th data-col="0">Accommodation Code</th>
							<th data-col="1">Accommodation Name</th>
							<th data-col="2">Address</th>
							<th data-col="3">Number of Beds</th>
							<th data-col="4">Application Status</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$properties = $application->showProperty($_SESSION["userId"]);

						foreach ($properties as $property) { ?>
							<tr>
								<td>
									<?php echo $property["prop_id"]; ?>
								</td>
								<td>
									<?php echo $property['prop_name']; ?>
								</td>
								<td>
									<?php echo $property['prop_address']; ?>
								</td>
								<td>
									<?php echo $property['prop_numBeds']; ?>
								</td>
								<td>
									<?php if ($property['prop_accreditStatus'] == "Accredited") {
										?>

										<a href="accreditationLetter.php?propName=<?php echo $property['prop_name']; ?>"
											class="btn btn-info" role="button">View Accreditation </a>

										<?php
									} else {
										echo $property['prop_accreditStatus'];

									}
									?>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>

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
	<script src="assets/js/filterSystem.js"></script>

</body>

</html>