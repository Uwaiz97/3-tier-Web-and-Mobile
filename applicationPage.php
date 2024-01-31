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

	<link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="icon">
	<link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="apple-touch-icon">
	<title>Apply for Accreditation Page</title>
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
			<div class="inner">
				</br>
				<h2>Apply For Accreditation</h2>

				<?php
				if (isset($_SESSION['error'])) {
					echo '<div class="alert alert-success rounded-pill text-center" style="border-color: #4CAF50; width: 1300px; height: 70px;">';
					echo '<p style="">' . $_SESSION['error'] . '</p>';
					echo '</div>';
					unset($_SESSION['error']);
				}
				?>

				<?php
				if (isset($_SESSION['success'])) {
					echo '<div class="alert alert-success rounded-pill text-center" style="border-color: #4CAF50; height: 70px;">';
					echo '<p style="">' . $_SESSION['success'] . '</p>';
					echo '</div>';
					unset($_SESSION['success']);
				}
				?>

				<div class="info-box">
					<h3>Important Information</h3>
					<p>This is the information you need to consider before applying:</p>
					<ul>
						<li>Accreditation is valid for the period of 12 months.</li>
						<li>The UJ POSA accreditation is not automatically carried over from year to year. New,
							returning as well as properties which are currently on three-year accreditation should all
							register and apply every year.</li>
						<li>Please note that we require you to make only one application and one payment per property.
							Please do not combine the property applications or payments</li>
						<li>Please note that the registration fee is non-refundable even if you decide to abandon
							the process at a later stage. </li>
					</ul>
				</div>

				<form action="includes/application.inc.php" method="post" enctype="multipart/form-data">
					<div class="application">

						<div class="field">
							<input type="text" name="propertyName" id="propertyName" placeholder="Property Name"
								required />
						</div>

						<div class="field">
							<input type="text" name="address" id="address" rows="3" placeholder="Address" required />
						</div>
					</div>
					<br>

					<div class="fields">
						<div class="field third">
							<input type="text" name="numBeds" id="numBeds" placeholder="Number of Beds" required />
						</div>
						<div class="field third">
							<p>Price: <span id="priceLabel">-</span></p>
						</div>
						<div class="field third">
							<button onclick="calculatePrice()">Calculate Price</button>
						</div>
					</div>

					<div class="application">

						<div class="field">
							<label for="companyRegister">1. Company Registration</label>
							<input type="file" name="companyRegister" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx"
								class="file-input" required>
							<div id="companyRegisterStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="proofOwnership">2. Proof of Ownership</label>
							<input type="file" id="proofOwnership" name="proofOwnership"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="proofOwnershipStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="taxPin">3. Tax Pin</label>
							<input type="file" id="taxPin" name="taxPin" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="taxPinStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="utilityBill">4. Utility Bill</label>
							<input type="file" id="utilityBill" name="utilityBill"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="utilityBillStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="liabilityCover">5. Liability Cover</label>
							<input type="file" id="liabilityCover" name="liabilityCover"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="liabilityCoverStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="certificateOccupancy">6. Certificate of Occuppancy</label>
							<input type="file" id="certificateOccupancy" name="certificateOccupancy"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="certificateOccupancyStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="landUseContent">7. Land Use Consent</label>
							<input type="file" id="landUseConsent" name="landUseConsent"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="landUseContentStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="zoningPermit">8. Zoning Permit</label>
							<input type="file" id="zoningPermit" name="zoningPermit"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="zoningPermitStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="buildingPlans">9. Building Plans</label>
							<input type="file" id="buildingPlans" name="buildingPlans"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="buildingPlansStatus" class="status">-</div>
						</div>

						<div class="field">
							<label for="proofOfPayment">10. Proof Of Payment </label>
							<input type="file" id="proofOfPayment" name="proofOfPayment"
								accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" class="file-input" required />
							<div id="proofOfPaymentStatus" class="status">-</div>
						</div>
					</div>
					<br>

					<div class="fields">
						<div class="field text-right">
							<label>&nbsp;</label>

							<ul class="actions">
								<li><input type="submit" name="submit" value="Submit Application" class="primary" />
								</li>
							</ul>
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
<script src="assets/js/checkPdfUpload.js"></script>
<script>
	function calculatePrice() {
		var numBeds = parseInt(document.getElementById("numBeds").value);

		if (numBeds >= 1 && numBeds <= 10) {
			document.getElementById("priceLabel").textContent = "R3035.00";
		} else if (numBeds >= 11 && numBeds <= 20) {
			document.getElementById("priceLabel").textContent = "R6050.00";
		} else if (numBeds >= 21 && numBeds <= 30) {
			document.getElementById("priceLabel").textContent = "R9036.50";
		} else if (numBeds >= 31 && numBeds <= 40) {
			document.getElementById("priceLabel").textContent = "R12100.00";
		} else if (numBeds >= 41 && numBeds <= 50) {
			document.getElementById("priceLabel").textContent = "R15125.00";
		} else if (numBeds >= 51 && numBeds <= 60) {
			document.getElementById("priceLabel").textContent = "R155881.25";
		} else if (numBeds >= 61 && numBeds <= 70) {
			document.getElementById("priceLabel").textContent = "R16754.73";
		} else if (numBeds >= 71 && numBeds <= 80) {
			document.getElementById("priceLabel").textContent = "R17760.06";
		} else if (numBeds >= 81 && numBeds <= 90) {
			document.getElementById("priceLabel").textContent = "R18914.41";
		} else if (numBeds >= 91 && numBeds <= 100) {
			document.getElementById("priceLabel").textContent = "R20427.50";
		} else if (numBeds > 100) {
			document.getElementById("priceLabel").textContent = "R24513.10";
		} else {
			document.getElementById("priceLabel").textContent = "Invalid Input";
		}
	}
</script>

</html>