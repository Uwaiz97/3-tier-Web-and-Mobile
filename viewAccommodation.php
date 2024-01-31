<?php
session_start();

include "classes/application-view.classes.php";
?>
<!DOCTYPE HTML>
<html>

<head>

	<link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="icon">
	<link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="apple-touch-icon">
	<title>View Accommodations</title>
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

			<div class="inner">
				<br>
				<h3 class="h3">Student Accommodations</h3>

				<br>

				<table id="issueTable">
					<thead>
						<tr>
							<th data-col="0">Accommodation Code</th>
							<th data-col="1">Property Name</th>
							<th data-col="2">Status</th>
							<th>View</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$application = new ApplicationView();
						$properties = $application->showAllProperties();

						foreach ($properties as $property) { ?>
							<tr>
								<td>
									<?php echo $property['prop_id']; ?>
								</td>
								<td>
									<?php echo $property['prop_name']; ?>
								</td>
								<td>
									<?php echo $property['prop_accreditStatus']; ?>
								</td>

								<td>
									<a href="aboutApplication.php?propid=
								<?php echo $property['prop_id']; ?>
								" class="btn btn-info" role="button">View</a>
								</td>

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