<?php
session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Reset Password </title>
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
				<a href="index.php" class="logo">
					<span class="fa fa-home"></span> <span class="title">POSA</span>
				</a>
			</div>
		</header>

		<!-- Main -->
		<div id="main">

			<form action="includes/login.inc.php" method="post" class="mx-1 mx-md-4">
				<div class="login">
					<div id="inside">
						<h2>Reset Password:</h2>
						<label for="email">Email:</label>
						<input type="email" id="email" name="email" required>
						<br>
						<label for="new_password">New Password:</label>
						<input type="password" id="password" name="password" required>
						<br>
						<label for="confirm_password">Confirm Password:</label>
						<input type="password" id="confirm_password" name="confirm_password" required>
						<!-- Add a hidden input field to identify that it's a password reset request -->
						<input type="hidden" name="reset_request" value="1">
						<br>
						<input type="submit" name="reset" Value="Reset" class="btn primary btn-secondary btn-block ">
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