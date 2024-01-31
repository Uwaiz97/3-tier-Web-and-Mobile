<?php
session_start();

include "classes/student-view.classes.php";

$userid = $_SESSION["userId"];

$student_view = new StudentView();
$result = $student_view->checkStudentAccomadation($userid);
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>About Maintenance Issues</title>
	<link
		href="https://upload.wikimedia.org/wikipedia/en/thumb/a/af/University_of_Johannesburg_Logo.svg/1200px-University_of_Johannesburg_Logo.svg.png"
		rel="icon">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/main.css" />


	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>

	<style>
		/* Basic styling for the box */
		.info-box {
			border: 1px solid #ccc;
			padding: 10px;
			width: 1300px;
			background-color: #f9f9f9;
		}

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
				<a href="studentHomePage.php" class="logo">
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
				<?php if ($result == false) { ?>
					<li><a href="StudentRegister.php">Register To Student Accomadation</a></li>
				<?php } elseif ($result == true) { ?>
					<li><a href="StudentReportMaintenanceIssue.php">Report Maintenance Issue</a></li>
					<li><a href="viewMaintenanceStatus.php">Confrim Maintenance Issue Resolved</a></li>
					<li><a href="StudentReportToPOSA.php">Report To POSA</a></li>
				<?php } ?>
                    <li><a href="listAccommodation.php">View Accommodations</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">
			<div class="inner">
				<br>

				<h2>Query Status:</h2>
				<table id="issueTable">
					<thead>
						<tr>
							<th data-col="0">Title</th>
							<th data-col="1">Date</th>
							<th data-col="2">Priority Level</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$queries = $student_view->showStudentUnconfirmedQueries($_SESSION["userId"]);
						if (empty($queries)) {
							?>
							<tr>
								<td></td>
								<td></td>
								<td><h3>No Queries</td>
							</tr>
							<?php
						} else {
							foreach ($queries as $query) {
								?>
								<tr>
									<td>
										<?php echo $query['query_title']; ?>
									</td>
									<td>
										<?php echo $query['query_date']; ?>
									</td>
									<td>
										<?php echo $query['query_priorityLvl']; ?>
									</td>
									<td>
										<form method="post" action="includes/studentConfirmResolved.inc.php">
											<input type="hidden" name="queryId" value="<?php echo $query['query_id']; ?>">
											<input type="submit" name="resolved" class="btn btn-info" value="Resolved">
											<input type="submit" name="unresolved" class="btn btn-info" value="Not Resolved">
										</form>
									</td>
								</tr>
							<?php }
						} ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<?php include 'footer.php'; ?>
</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/filterSystem.js"></script>

</html>