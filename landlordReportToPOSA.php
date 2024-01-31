<!DOCTYPE HTML>
<html>
	<head>
		<title>Report</title>
		<link href="https://upload.wikimedia.org/wikipedia/en/thumb/a/af/University_of_Johannesburg_Logo.svg/1200px-University_of_Johannesburg_Logo.svg.png" rel="icon">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
							<li><a href="#">View Accomadations</a></li>
						</ul>
						<li><a href="includes/logout.inc.php">Log Out</a></li>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							
								<h2>Report Issue</h2>
								<form method="post" action="includes/applicationHandler.php">
									<div class="fields">
                                        <div class="field half">
                                            <input type="text" name="studentID" id="studentID" placeholder="Student Accommodation" />
                                        </div>

										<div class="field half">
											<input type="text" name="title" id="title" placeholder="Report Title" />
										</div>


										<div class="field">
											<textarea name="description" id="description" rows="3" placeholder="Description"></textarea>
										</div>

										<div class="field text-right">
											<label>&nbsp;</label>

											<ul class="actions">
												<li><input type="submit" value="Submit Issue Report" class="primary" /></li>
											</ul>
										</div>
									</div>
								</form>
								
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