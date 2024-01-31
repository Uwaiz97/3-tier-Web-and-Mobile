<?php
session_start();

include "classes/dbh.classes.php";
include "classes/application.classes.php";
include "classes/application-view.classes.php";
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Inspection List</title>
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
				<a href="inspectionHome.php" class="logo">
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
				<li><a href="inspectionHandler.php">Available Inspections</a></li>
				<li><a href="inspectionList.php">My Inspections</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">

			<br>
			<br>

			<div class="inner">

				<h2 class="h2">Accommodation List </h2>

				<br>

				<table>
					<tr>
						<th>Accommodation Code</th>
						<th>Accommodation Name</th>
						<th>Address Line 1</th>
						<th>Number of Beds</th>
						<th></th>
					</tr>

					<?php
					$application = new ApplicationView();
					$userid = $_SESSION["userId"];

					$staffType = $application->showStaffType($userid);

					if ($staffType == "Co-Ordinator") {
						$properties = $application->showOCAInspPendingProperty($userid);
					} elseif ($staffType == "OHS") {
						$properties = $application->showOHSInspPendingProperty($userid);
					} elseif ($staffType == "Security") {
						$properties = $application->showSecInspPendingProperty($userid);
					}

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
								<a href="inspection.php?propid=<?php echo $property['prop_id']; ?>" class="btn btn-info"
									role="button">Inspect</a>
							</th>
						</tr>
					<?php } ?>
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

</body>

</html>