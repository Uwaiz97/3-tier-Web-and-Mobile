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
				<a href="index.php" class="logo">
					<span class="fa fa-home"></span> <span class="title">POSA</span>
				</a>
			</div>
		</header>

		<!-- Main -->
		<div id="main">

			<form action="includes/register.inc.php" method="post">

				<div class="login">
					<div class="pageHeader">
						<h2>Register</h2>



						<?php
						if (isset($_SESSION['error'])) {
							echo '<div class="alert alert-success rounded-pill text-center" style="border-color: blue; height: 70px;">';
							echo '<p style="">' . $_SESSION['error'] . '</p>';
							echo '</div>';
							unset($_SESSION['error']);
						}
						?>


						<div class="inside1">

							<div class="field1">
								<input type="text" name="name" id="name" placeholder="Name" />
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

							<div class="field1">
								<input type="password" name="password" id="password" placeholder="Password" required />
							</div>

							<div class="field1">
								<input type="password" name="confirm_password" id="confirm_password"
									placeholder="Confirm Password" required />
							</div>
						</div>

						<br>
						<lable>
							<b>User Type</b>
						</lable>
						<div class="inside1">
							<div class="field1">
								<input type="radio" id="Student" value="Student" name="userType">
								<label for="Student">Student</label><br>
							</div>
							<div class="field1">
								<input type="radio" id="Landlord" value="Landlord" name="userType">
								<label for="Landlord">Landlord</label>
							</div>
						</div>
						<div class="field">
							<input type="text" name="studentNo" id="studentNo"
								placeholder="Student Number (Student Only)" style="display: none" />
						</div>

						<br>
						<div class="field text-right">
							<ul class="actions">
								<li><input type="submit" name="register" value="register" class="primary" /></li>
							</ul>

						</div>
						<p>Already have an account? <a href="index.php"><b>Login</b> </a></p>
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
	<script>
        const studentRadio = document.getElementById("Student");
        const studentNoInput = document.getElementById("studentNo");

        const userTypeRadios = document.getElementsByName("userType");
        userTypeRadios.forEach(function (radio) {
            radio.addEventListener("change", function () {
                if (studentRadio.checked) {
                    studentNoInput.style.display = "block";
                } else {
                    studentNoInput.style.display = "none";
                }
            });
        });
    </script>	
</body>

</html>