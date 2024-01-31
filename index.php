<?php
session_start();

?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Login</title>
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
		<br>
		<!-- Main -->
		<div id="main">

			<form action="includes/login.inc.php" method="post" class="mx-1 mx-md-4">
				<div class="login">
					<div id="inside">
						<h2>Login</h2>

						<?php
						if (isset($_SESSION['error'])) {
							echo '<p><span style="color: red; border: 1px solid red; background-color: #FFCCCC;  text-decoration: none; border-radius: 5px;">' . $_SESSION['error'] . '</span></p>';
							unset($_SESSION['error']);
						}

						if (isset($_SESSION['success'])) {
							echo '<div class="alert alert-success rounded-pill text-center" style="border-color: #4CAF50; height: 70px;">';
							echo '<p style="">' . $_SESSION['success'] . '</p>';
							echo '</div>';
							unset($_SESSION['success']);
						}
						?>

						<div class="field">
							<input type="email" name="email" id="email" placeholder="email" />
						</div>

						<div class="field">
							<input type="password" name="password" id="password" placeholder="password" />
						</div>

						<div class="d-grid gap-2 mt-3">
							<input type="submit" name="login" Value="Login" class="btn primary btn-secondary btn-block "
								value="Login">
						</div>

						<br>
						<div class="form-check ">
							<span class="small fw-bold mt-2 pt-1 mb-0">Forgot your password? <b><a
										href="forgottenPassword.php" class="link-danger">Reset Password</b></a></span>
						</div>

						<div class="form-check ">
							<span class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <b><a href="Register.php"
										class="link-danger">Register</b></a></span>
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