<?php
session_start();

include "classes/dbh.classes.php";
include "classes/application.classes.php";
include "classes/application-view.classes.php";
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Handle Applications</title>
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
				<a href="posaAdmin.php" class="logo">
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

			<br>
			<br>

			<div class="inner">

				<h2 class="h2">Application Handling</h2>

				<br>

				<table id="issueTable">
					<thead>
						<tr>
							<th data-col="0">Accommodation Code</th>
							<th data-col="1">Accommodation Name</th>
							<th data-col="2">Address</th>
							<th data-col="3">Number of Beds</th>
							<th>View Application</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$application = new ApplicationView();
						$properties = $application->showDocPendingProperty();

						foreach ($properties as $property) { ?>
							<tr>
								<td>
									<?php echo $property['prop_id']; ?>
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
								<th>
									<a href="aboutApplication.php?propid=
								<?php echo $property['prop_id']; ?>
								" class="btn btn-info" role="button">View</a>
								</th>
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