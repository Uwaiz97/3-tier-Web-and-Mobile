<?php
session_start();

include "classes/dbh.classes.php";
include "classes/application.classes.php";
include "classes/application-view.classes.php";
include "classes/student-view.classes.php";

$userid = $_SESSION["userId"];

$student_view = new StudentView();
$result = $student_view->checkStudentAccomadation($userid);
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Accomadation List</title>
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
				<a href="#" class="logo">
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
					<li><a href="StudentRegister.php">Register To Student Accommodation</a></li>
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
				<h3 class="h3"> Accredited Student Accommodation</h3>

				<br>

				<table id="issueTable">
					<thead>
						<tr>
							<th data-col="1">Accommodation Name</th>
							<th data-col="2">Address</th>
							<th data-col="3">Accommodation Rating</th>
							<th data-col="4">Number of Available Rooms</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$application = new ApplicationView();
						$st = new StudentView();
						$students = $st->getAllStudents();
						$counter = 0;
						$properties = $application->showAccreditProperty();
						$inspectionstotalRating = 0;

						foreach ($properties as $property) { ?>
							<tr>

								<td>
									<?php echo $property['prop_name']; ?>
								</td>
								<td>
									<?php echo $property['prop_address']; ?>
								</td>
								<?php

								foreach ($application->GetInspections() as $inspection) {
									if ($property["prop_id"] == $inspection["prop_id"]) {

										if ($inspection["insp_nMatrass"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_matrassTotalRate"] / $inspection["insp_nMatrass"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nCurtains"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_curtainsTotalRate"] / $inspection["insp_nCurtains"]);
											$inspectionstotalRating += $AVG;

										}

										if ($inspection["insp_nPaperBins"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_paperBinsTotalRate"] / $inspection["insp_nPaperBins"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nBookshelves"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_bookshTotalRate"] / $inspection["insp_nBookshelves"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nDesks"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_desksTotalRate"] / $inspection["insp_nDesks"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nChairs"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_chairsTotalRate"] / $inspection["insp_nChairs"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nWardrobes"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_wardrobesTotalRate"] / $inspection["insp_nWardrobes"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nHeaters"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_heatersTotalRate"] / $inspection["insp_nHeaters"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nStudyLamp"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_studyLampTotalRate"] / $inspection["insp_nStudyLamp"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nFridges"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_fridgesTotalRate"] / $inspection["insp_nFridges"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nMicrowaves"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_microwavesTotalRate"] / $inspection["insp_nMicrowaves"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nShowers"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_showersTotalRate"] / $inspection["insp_nShowers"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nLaundryFac"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_laundryFacTotalRate"] / $inspection["insp_nLaundryFac"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nLckCupboards"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_lckCupboardstotalRate"] / $inspection["insp_nLckCupboards"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nToilets"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_toiletstotalRate"] / $inspection["insp_nToilets"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nBasins"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_basinsTotalRate"] / $inspection["insp_nBasins"]);
											$inspectionstotalRating += $AVG;
										}

										if ($inspection["insp_nSheBins"] == 0) {
											$AVG = 0;
										} else {
											$AVG = ($inspection["insp_sheBinsTotalRate"] / $inspection["insp_nSheBins"]);
											$inspectionstotalRating += $AVG;
										}

										////////// //////OHS/////// ////////////
							
										//fire alarm
										if ($inspection["insp_fireAlarm"] != "false") {
											$inspectionstotalRating += 2;
										}

										//smoke detector
										if ($inspection["insp_smkDetect"] != "false") {
											$inspectionstotalRating += 2;
										}

										//fire extinguishers
										if ($inspection["insp_extinguishers"] != "false") {
											$inspectionstotalRating += 2;
										}

										//first aid
										if ($inspection["insp_firstAid"] != "false") {
											$inspectionstotalRating += 2;
										}

										//emergency numbers & procedures
										if ($inspection["insp_emgyNum"] != "false") {
											$inspectionstotalRating += 2;
										}

										//exit doors
										if ($inspection["insp_exitDoors"] != "false") {
											$inspectionstotalRating += 2;
										}

										//fire blankets
										if ($inspection["insp_fireBlankets"] != "false") {
											$inspectionstotalRating += 2;
										}

										//fire equipment signage
										if ($inspection["insp_fireEqptSign"] != "false") {
											$inspectionstotalRating += 2;
										}

										//db board signage
										if ($inspection["insp_dbBrdSign"] != "false") {
											$inspectionstotalRating += 2;
										}

										//emergency exit route
										if ($inspection["insp_emgyExitRoute"] != "false") {
											$inspectionstotalRating += 2;
										}

										///// //////////SEC///////////// //////
							
										//fence
										if ($inspection["insp_fence"] != "false") {
											$inspectionstotalRating += 2;
											;
										}

										//gates
										if ($inspection["insp_gates"] != "false") {
											$inspectionstotalRating += 2;
										}

										//burglar proofing
										if ($inspection["insp_burglarProof"] != "false") {
											$inspectionstotalRating += 2;
										}

										//cctv
										if ($inspection["insp_cctv"] != "false") {
											$inspectionstotalRating += 2;
										}

										//armed response
										if ($inspection["insp_armedResp"] != "false") {
											$inspectionstotalRating += 2;
										}

										//panic btn
										if ($inspection["insp_panicBTN"] != "false") {
											$inspectionstotalRating += 2;
										}

										//room locks
										if ($inspection["insp_roomLocks"] != "false") {
											$inspectionstotalRating += 2;
										}

										//security
										if ($inspection["insp_security"] != "false") {
											$inspectionstotalRating += 2;
										}

										//emergency exit route
										if ($inspection["insp_lighting"] != "false") {
											$inspectionstotalRating += 2;
										}
										$divide = ceil(($inspectionstotalRating / 36) * 50);

									}

								}
								foreach ($students as $student) {
									if ($property["prop_id"] == $student["prop_id"]) {
										$counter = +$counter;
									}
								}
								?>

								<td>
									<?php echo $divide; ?>
								</td>

								<td>
									<?php echo $property["prop_numBeds"] - $counter; ?>
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