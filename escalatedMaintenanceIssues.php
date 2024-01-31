<?php
session_start();

include "classes/dbh.classes.php";
include "classes/student.classes.php";
include "classes/student-view.classes.php";
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Escalated Issues</title>
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
				<li><a href="escalated.php">View Escalated Issues</a></li>
				<li><a href="adminReports.php">View Reported Issues</a></li>
				<li><a href="registerEmployee.php">Register Staff Member</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">

			<br>
			<br>

			<div class="inner">

				<h2 class="h2">Escalated Issues</h2>

				<br>

				<table>
					<tr>
						<th>Accomodation Name</th>
                        <th>Landlord Name</th>
						<th>Room Number</th>
						<th>Issue</th>
						<th>Student Name</th>
						<th>Date/Time Logged</th>
                        <th>view</th>
						<th></th>
					</tr>
                    <tr>
								<td>
								<p>accommodation name</p>
								</td>
                                
                                <td>
                                <p>landlord name</p>
                                </td>

                                <td>
								<p>room number</p>
								</td>


								<td>
								<p>issue</p>
								</td>

                                <td>
                                <p>student name</p>
								</td>

                                <td>
                                <p>date</p>
								</td>


                                <td>
								<a href="inspection.php?prop=" class="btn btn-info"
									role="button">View</a>
                                </td>
							</tr>

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