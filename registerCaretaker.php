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
			<h2>Menu</h2>
			<ul>
				<li>
					<a href="#" class="dropdown-toggle">Accreditation</a>

					<ul>
						<li><a href="applicationPage.php">Apply for Accreditation</a></li>
						<li><a href="viewApplicationStatusPage.php">View Accreditation Status</a></li>
					</ul>
				</li>

				<li>
					<a href="#" class="dropdown-toggle">Students</a>

					<ul>
						<li><a href="confirmStudentPage.php">Confirm Students</a></li>
						<li><a href="maintenanceIssues.php">View Maintenance Issues</a></li>
						<li><a href="reportPage.php">Report Student</a></li>
					</ul>
				</li>
				<li><a href="registerCaretaker.php">Register Caretaker</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">

			<form action="includes/register.inc.php" method="post">

				<div class="login">
					<div class="pageHeader">
						<h2>Register Caretaker</h2>
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

							<div class="field text-right">
								<label>&nbsp;</label>
								<ul class="actions">
									<li><input type="submit" name="registerCaretaker" value="register caretaker"
											class="primary" />
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

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