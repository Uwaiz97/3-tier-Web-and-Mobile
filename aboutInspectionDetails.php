<?php
session_start();

include "classes/dbh.classes.php";
include "classes/inspection.classes.php";
include "classes/inspection-view.classes.php";

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Inpected List</title>
	<link
		href="https://upload.wikimedia.org/wikipedia/en/thumb/a/af/University_of_Johannesburg_Logo.svg/1200px-University_of_Johannesburg_Logo.svg.png"
		rel="icon">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/main.css" />


	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="assets/css/statisticsTable.css" />

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
				<li><a href="escalated.php">View Escalated Issues</a></li>
				<li><a href="adminReports.php">View Reported Issues</a></li>
				<li><a href="registerEmployee.php">Register Staff Member</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<?php
		$inspectionView = new InspectionView();
		$inspection = $inspectionView->showInspection($_GET['inspid']);
		$property = $inspectionView->getInspectedProperty($inspection[0]["prop_id"]);
		$systemComments = $inspectionView->checkIfMinimumMet($inspection[0], $property[0]['prop_numBeds']);
		$oca = $inspectionView->showInspector($inspection[0]["oca_Id"]);
		$ohs = $inspectionView->showInspector($inspection[0]["ohs_Id"]);
		$sec = $inspectionView->showInspector($inspection[0]["sec_Id"]);
		$comments = $inspectionView->showInspectionComments($inspection[0]["insp_id"]);
		?>

		<!-- Main -->
		<div id="main">
			<div class="inner">
				</br>

				<h2>Co-ordinator Inspector Details:</h2>
				<table>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Inspection Date</th>
					</tr>

					<tr>
						<td>
							<?php echo $oca['user_name']; ?>
						</td>
						<td>
							<?php echo $oca['user_email']; ?>
						</td>
						<td>
							<?php echo $oca['user_phoneNo']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_ocaDate']; ?>
						</td>
					</tr>
				</table>

				<br>
				<h3>Room Details:</h3>
				<table class="statistics-table">
					<tr>
						<th>Items</th>
						<th>Number of Items</th>
						<th>Total Rating</th>
						<th>Unusable</th>
					</tr>

					<!-- <tr>
						<th>Sharing Rooms</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
					<tr>
						<th>Single Rooms</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr> -->

					<tr>
						<th>Beds</th>
						<td>
							<?php echo $inspection[0]['insp_nMatrass']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_matrassTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nMatrassBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Curtains</th>
						<td>
							<?php echo $inspection[0]['insp_nCurtains']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_curtainsTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nCurtainsBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Paper Bins</th>
						<td>
							<?php echo $inspection[0]['insp_nPaperBins']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_paperBinsTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nPaperBinsBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>BookShelves</th>
						<td>
							<?php echo $inspection[0]['insp_nBookshelves']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_bookshTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nBookshelvesBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Desks</th>
						<td>
							<?php echo $inspection[0]['insp_nDesks']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_desksTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nDesksBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Chairs</th>
						<td>
							<?php echo $inspection[0]['insp_nChairs']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_chairsTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nChairsBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Wardrobes</th>
						<td>
							<?php echo $inspection[0]['insp_nWardrobes']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_wardrobesTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nWardrobesBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Heaters</th>
						<td>
							<?php echo $inspection[0]['insp_nHeaters']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_heatersTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nHeatersBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Study Lamps</th>
						<td>
							<?php echo $inspection[0]['insp_nStudyLamp']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_studyLampTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nStudyLampBelow']; ?>
						</td>
					</tr>
				</table>

				<br>
				<h3>Kitchen Details:</h3>
				<table class="statistics-table">
					<tr>
						<th>Items</th>
						<th>Number of Items</th>
						<th>Total Rating</th>
						<th>Unusable</th>
					</tr>

					<tr>
						<th>Stoves</th>
						<td>
							<?php echo $inspection[0]['insp_nStoves']; ?>(
							<?php echo $inspection[0]['insp_nStovePlates']; ?>)
						</td>
						<td>
							<?php echo $inspection[0]['insp_stovesTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nStovesBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Fridges</th>
						<td>
							<?php echo $inspection[0]['insp_nFridges']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_fridgesTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nFridgesBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Microwaves</th>
						<td>
							<?php echo $inspection[0]['insp_nMicrowaves']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_microwavesTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nMicrowavesBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Lock cupboards</th>
						<td>
							<?php echo $inspection[0]['insp_nLckCupboards']; ?>(
							<?php echo $inspection[0]['insp_nLckCupboardsShelves']; ?>)
						</td>
						<td>
							<?php echo $inspection[0]['insp_lckCupboardstotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nLckCupboardsBelow']; ?>
						</td>
					</tr>
					</tr>

					<tr>
						<th>Counter Tops</th>
						<td>
							<?php echo $inspection[0]['insp_nCntrTops']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_cntrTopsTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nCntrTopsBelow']; ?>
						</td>
					</tr>
				</table>

				<br>
				<h3>Bathroom Details:</h3>
				<table class="statistics-table">
					<tr>
						<th>Items</th>
						<th>Number of Items</th>
						<th>Total Rating</th>
						<th>Unusable</th>
					</tr>

					<tr>
						<th>Toilets</th>
						<td>
							<?php echo $inspection[0]['insp_nToilets']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_toiletstotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nToiletsBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Basins</th>
						<td>
							<?php echo $inspection[0]['insp_nBasins']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_basinsTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nBasinsBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>Laundry Facilities </th>
						<td>
							<?php echo $inspection[0]['insp_nLaundryFac']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_laundryFacTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nLaundryFacBelow']; ?>
						</td>
					</tr>

					<tr>
						<th>She Bins</th>
						<td>
							<?php echo $inspection[0]['insp_nSheBins']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_sheBinsTotalRate']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_nSheBinsBelow']; ?>
						</td>
					</tr>
				</table>
				<br>

				<h2>Occupational Health Safety inspector Details:</h2>
				<table>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Inspection Date</th>
					</tr>

					<tr>
						<td>
							<?php echo $ohs['user_name']; ?>
						</td>
						<td>
							<?php echo $ohs['user_email']; ?>
						</td>
						<td>
							<?php echo $ohs['user_phoneNo']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_ohsDate']; ?>
						</td>
					</tr>
				</table>
				<br>

				<h3>Health Safety Details:</h3>
				<table class="statistics-table">
					<tr>
						<th>Item</th>
						<th>Available</th>
					</tr>

					<tr>
						<th>Fire Extinguishers</th>
						<td>
							<?php if ($inspection[0]['insp_extinguishers'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Board Signs</th>
						<td>
							<?php if ($inspection[0]['insp_dbBrdSign'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Exit Doors</th>
						<td>
							<?php if ($inspection[0]['insp_exitDoors'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Smoke Detectors</th>
						<td>
							<?php if ($inspection[0]['insp_smkDetect'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Fire Blankets</th>
						<td>
							<?php if ($inspection[0]['insp_fireBlankets'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Emergency Number</th>
						<td>
							<?php if ($inspection[0]['insp_emgyNum'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Fire Alarm</th>
						<td>
							<?php if ($inspection[0]['insp_fireAlarm'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Emergency Exit Route</th>
						<td>
							<?php if ($inspection[0]['insp_emgyExitRoute'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>


					<tr>
						<th>Emergency Sign</th>
						<td>
							<?php if ($inspection[0]['insp_emgySigns'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Fire Equipment Sign</th>
						<td>
							<?php if ($inspection[0]['insp_fireEqptSign'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>First Aid</th>
						<td>
							<?php if ($inspection[0]['insp_firstAid'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>
				</table>

				<br>
				<h2>Security Inspector Details:</h2>
				<table>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Inspection Date</th>
					</tr>

					<tr>
						<td>
							<?php echo $sec['user_name']; ?>
						</td>
						<td>
							<?php echo $sec['user_email']; ?>
						</td>
						<td>
							<?php echo $sec['user_phoneNo']; ?>
						</td>
						<td>
							<?php echo $inspection[0]['insp_secDate']; ?>
						</td>
					</tr>
				</table>
				<br>

				<h3>Security Details:</h3>
				<table class="statistics-table">
					<tr>
						<th>Item</th>
						<th>Available</th>
					</tr>

					<tr>
						<th>Gate</th>
						<td>
							<?php if ($inspection[0]['insp_gates'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Fences</th>
						<td>
							<?php if ($inspection[0]['insp_fence'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Panic Button</th>
						<td>
							<?php if ($inspection[0]['insp_panicBTN'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>CCTV Camera</th>
						<td>
							<?php if ($inspection[0]['insp_cctv'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Buglar Proof</th>
						<td>
							<?php if ($inspection[0]['insp_burglarProof'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Armed Response</th>
						<td>
							<?php if ($inspection[0]['insp_armedResp'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Room Lock</th>
						<td>
							<?php if ($inspection[0]['insp_roomLocks'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Security</th>
						<td>
							<?php if ($inspection[0]['insp_security'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>

					<tr>
						<th>Lighting</th>
						<td>
							<?php if ($inspection[0]['insp_lighting'] == 1) {
								echo "YES";
							} else {
								echo "NO";
							}
							; ?>
						</td>
					</tr>
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

</html>