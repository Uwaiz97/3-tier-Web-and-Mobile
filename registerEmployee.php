<?php
session_start();

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>POSA | Register</title>
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
			<form action="includes/register.inc.php" method="post">


				<div class="login">
					<div class="pageHeader">
						<h2>Register</h2>
						<?php
						if (isset($_SESSION['success'])) {
							echo '<div class="alert alert-success rounded-pill text-center" style="border-color: blue; height: 70px;">';
							echo '<p style="">' . $_SESSION['success'] . '</p>';
							echo '</div>';
							unset($_SESSION['success']);
						}
						?>
						<div class="inside1">

							<div class="field1">
								<input type="text" name="name" id="name" placeholder="Name" required />
							</div>

							<div class="field1">
								<input type="text" name="surname" id="surname" placeholder="Surname" required />
							</div>

							<div class="field1">
								<input type="email" name="email" id="email" placeholder="Email" required />
							</div>
							<div class="field1">
								<input type="text" name="phone" id="phone" placeholder="Phone" required />
							</div>

							<!--
							<div class="field1">
								<input type="password" name="password" id="password" placeholder="Password" required />
							</div>

							<div class="field1">
								<input type="password" name="confirm_password" id="confirm_password"
									placeholder="Confirm Password" required />
							</div>
							!-->

							<div class="field1">
								<lable>
									<b>User Type</b>
								</lable>
								<br>
								<input type="radio" id="Administrator" value="Administrator" name="userType">
								<label for="Administrator">Administrator</label><br>
								<input type="radio" id="Co-Ordinator" value="Co-Ordinator" name="userType">
								<label for="Co-Ordinator">Co-Ordinator</label>
								<input type="radio" id="OHS" value="OHS" name="userType">
								<label for="OHS">OHS</label><br>
								<input type="radio" id="Security" value="Security" name="userType">
								<label for="Security">Security</label>
							</div>
							<div class="field text-right">
								<label>&nbsp;</label>
								<ul class="actions">
									<li><input type="submit" name="registerStaff" value="register" class="primary" />
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<br>
		<!-- Footer -->
		<?php include 'footer.php'; ?>
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>

</html>