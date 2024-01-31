<?php
session_start();

include "classes/dbh.classes.php";
include "classes/application.classes.php";
include "classes/application-view.classes.php";
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Student Register</title>
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
				<li><a href="StudentRegister.php">Register To Student Accomadation</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">
			<br>
			<form method="post" class="mx-1 mx-md-4" action="includes/register.inc.php">
				<div class="login">
					<div id="inside">
						<h2>Register as a student</h2>

						<div class="field">
							<select name="prop_id" id="prop_id">
								<option value="">Select Accomadation</option>
								<?php
								$application = new ApplicationView();
								$properties = $application->showAccreditProperty();

								foreach ($properties as $property) { ?>
									<option value="<?php echo $property['prop_id']; ?>">
										<?php echo $property['prop_name']; ?>
									</option>
								<?php } ?>
							</select>
						</div>

						<div class="field">
							<input type="text" name="rommNo" id="rommNo" placeholder="Room Number" />
						</div>

						<div class="d-grid gap-2 mt-3">
							<input type="submit" name="registerStudent" Value="Submit"
								class="btn primary btn-secondary btn-block">
						</div>

					</div>
				</div>
			</form>
			<br>
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