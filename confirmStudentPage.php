<?php
session_start();

include "classes/dbh.classes.php";
include "classes/student.classes.php";
include "classes/student-view.classes.php";

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
	<title>Confirm Students</title>
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

				<h2 class="h2">View Students Register</h2>

				<br>
				<table id="issueTable">
					<thead>
						<tr>
							<th data-col="0">Accomodation Code</th>
							<th data-col="1">Accomodation Name</th>
							<th data-col="2">Student Number</th>
							<th data-col="3">First Name</th>
							<th data-col="4">Last Name</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php
						$studentView = new StudentView();
						$userid = $_SESSION["userId"];
						$properties = $studentView->showLandlordPropeties($userid);

						foreach ($properties as $property) {
							$students = $studentView->showPendingStudents($property['prop_id']);

							foreach ($students as $student) {
								$user = $studentView->showUser($student['student_id']) ?>
								<tr>
									<th>
										<?php echo $property['prop_id']; ?>
									</th>
									<th>
										<?php echo $property['prop_name']; ?>
									</th>
									<th>
										<?php echo $student['student_number']; ?>
									</th>
									<th>
										<?php echo $user['user_name']; ?>
									</th>
									<th>
										<?php echo $user['user_surname']; ?>
									</th>
									<form action="includes/studentConfirm.inc.php" method="post">
										<input type="hidden" name="studentId" value="<?php echo $student['student_id'] ?>">
										<th>
											<input type="submit" name="accept" class="btn btn-info" value="Accept">
											<input type="submit" name="decline" class="btn btn-info" value="Decline">
										</th>
									</form>
								</tr>
							<?php }
						} ?>
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