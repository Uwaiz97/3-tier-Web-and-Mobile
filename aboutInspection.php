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
				</br>
				<h2>Accommodation Details:</h2>
				<table>
					<thead>
						<tr>
							<th>Accommodation Code</th>
							<th>Accommodation Name</th>
							<th>Address Line</th>
							<th>Number of Beds</th>
						</tr>
					</thead>
					<tbody>

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
						<tr>
							<td>
								<?php echo $inspection[0]["prop_id"]; ?>
							</td>
							<td>
								<?php echo $property[0]['prop_name']; ?>
							</td>
							<td>
								<?php echo $property[0]['prop_address']; ?>
							</td>
							<td>
								<?php echo $property[0]['prop_numBeds']; ?>
							</td>
						</tr>
					</tbody>

				</table>

				<h3>Inspector Details:</h3>
				<table>
					<thead>
						<tr>
							<th>Type</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone Number</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>Co-Ordinator</td>
							<td>
								<?php echo $oca['user_name']; ?>
							</td>
							<td>
								<?php echo $oca['user_email']; ?>
							</td>
							<td>
								<?php echo $oca['user_phoneNo']; ?>
							</td>
						</tr>

						<tr>
							<td>OHS</td>
							<td>
								<?php echo $ohs['user_name']; ?>
							</td>
							<td>
								<?php echo $ohs['user_email']; ?>
							</td>
							<td>
								<?php echo $ohs['user_phoneNo']; ?>
							</td>
						</tr>

						<tr>
							<td>Security</td>
							<td>
								<?php echo $sec['user_name']; ?>
							</td>
							<td>
								<?php echo $sec['user_email']; ?>
							</td>
							<td>
								<?php echo $sec['user_phoneNo']; ?>
							</td>
						</tr>
					</tbody>
				</table>

				<br>
				<div>
					<h3>Property Faults:</h3>
					<?php

					$parts = explode("/", $comments[0]["insp_commentSection"]);
					$length = count($parts);
					$counter = -1;

					//Variables
					$ocaRoom = array();
					$ocaKitchen = array();
					$ocaBathroom = array();
					$ohs = array();
					$sec = array();

					while ($counter < $length - 1) {
						$counter += 1;
						if ($parts[$counter] == "oca") {
							$counter += 1;
							if ($parts[$counter] == "room") {
								$counter += 1;
								$ocaRoom[] = $parts[$counter];
							} elseif ($parts[$counter] == "kitchen") {
								$counter += 1;
								$ocaKitchen[] = $parts[$counter];
							} elseif ($parts[$counter] == "bathroom") {
								$counter += 1;
								$ocaBathroom[] = $parts[$counter];
							}
						} elseif ($parts[$counter] == "ohs") {
							$counter += 2;
							$ohs[] = $parts[$counter];
						} elseif ($parts[$counter] == "sec") {
							$counter += 2;
							$sec[] = $parts[$counter];
						}
					} ?>
				</div>

				<form method="post" action="#">

					<h4>Co-Ordinator</h4>
					<div class="fields">

						<div class="field third">
							<label>Rooms</label>

							<?php foreach ($ocaRoom as $comment) { ?>
								<p>
									<?php echo "- ";
									echo $comment; ?>
								</p>
							<?php } ?>
						</div>

						<div class="field third">
							<label>Kitchens</label>

							<?php foreach ($ocaKitchen as $comment) { ?>
								<p>
									<?php echo "- ";
									echo $comment; ?>
								</p>
							<?php } ?>
						</div>

						<div class="field third">
							<label>Bathrooms</label>

							<?php foreach ($ocaBathroom as $comment) { ?>
								<p>
									<?php echo "- ";
									echo $comment; ?>
								</p>
							<?php } ?>
						</div>
					</div>

					<div class="fields">
						<div class="field third">
							<label>System Comments</label>

							<?php foreach ($systemComments as $comment) { ?>
								<p>
									<?php echo "- ";
									echo $comment; ?>
								</p>
							<?php } ?>
						</div>

						<div class="field third">
							<label>Occupional Health & Safety</label>

							<?php foreach ($ohs as $comment) { ?>
								<p>
									<?php echo "- ";
									echo $comment; ?>
								</p>
							<?php } ?>
						</div>

						<div class="field third">
							<label>Security</label>

							<?php foreach ($sec as $comment) { ?>
								<p>
									<?php echo "- ";
									echo $comment; ?>
								</p>
							<?php } ?>
						</div>

					</div>
				</form>

				<div>
					<!-- <h3>View Full Property Inspection:</h3> -->
					<a href="aboutInspectionDetails.php?inspid=<?php echo $_GET['inspid']; ?>" class="btn btn-info"
						role="button">View Full Property Inspection</a>
				</div>
				<br>

				<form action="includes/aboutInspection.inc.php" method="post">
					<div class="fields">
						<div class="field text-right">

							<ul class="actions">
								<li><input type="submit" name="accredit" value="Approve For Accreditation"
										class="primary" /></li>
							</ul>

							<textarea type="text" name="declineComment"
								placeholder="Comments for declining accreditation">
							</textarea>

							<br>

							<ul class="actions">
								<li><input type="submit" name="decline" value="Decline Accreditation" class="primary" />
								</li>
							</ul>

							<input type="hidden" name="inspid" value="<?php echo $_GET['inspid']; ?>">

						</div>
					</div>
				</form>
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