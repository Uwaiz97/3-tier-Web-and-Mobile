<?php
session_start();

include "classes/student-view.classes.php";

$userid = $_SESSION["userId"];

$student_view = new StudentView();
$result = $student_view->checkStudentAccomadation($userid);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Home Page</title>
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
                <?php if ($result == false) { ?>
                    <li><a href="StudentRegister.php">Register To Student Accommodation</a></li>
                <?php } elseif ($result == true) { ?>
                    <li><a href="StudentReportMaintenanceIssue.php">Report Maintenance Issue</a></li>
                    <li><a href="viewMaintenanceStatus.php">Confrim Maintenance Issue Resolved</a></li>
                    <li><a href="StudentReportToPOSA.php">Report To POSA</a></li>
                <?php } ?>
                <li><a href="listAccommodation.php">View Accommodations</a></li>
                <li><a href="includes/logout.inc.php">Log Out</a></li>
            </ul>
        </nav>

        <!-- Main -->
        <div id="main">

            <div class="inner">
                <!-- About Us -->
                <header id="inner">
                    <h2> Student Home</h2>
                    <?php if ($result == false) { ?>
                        <h1>Register To Student Accomadation Now!</h1>
                    <?php } elseif ($result == true) { ?>
                        <h2>Welcome to your POSA portal</h2>
                    <?php } ?>
                </header>

                <?php if ($result == false) { ?>
                    <section class="tiles">
						<article class="style1">
							<span class="image">
								<img src="images/register.png" alt="" height="350" />
							</span>

							<a href="StudentRegister.php">
								<h2> Register to Accommodation</h2>
							</a>
						</article>

						<article class="style2">
							<span class="image">
								<img src="images/viewProp.png" alt="" height="350" />
							</span>

							<a href="listAccommodation.php">
								<h2> View Accommodations</h2>
							</a>
						</article>
                    </section>
                <?php } elseif ($result == true) { ?>
                    <h2 class="h2">Dashboard</h2>
                    <section class="tiles">
						<article class="style1">
							<span class="image">
								<img src="images/query.png" alt="" height="350" />
							</span>

							<a href="StudentReportMaintenanceIssue.php">
								<h2> Report Maintenance Issue</h2>
							</a>
						</article>

						<article class="style2">
							<span class="image">
								<img src="images/status.png" alt="" height="350" />
							</span>

							<a href="viewMaintenanceStatus.php">
								<h2> Confrim Maintenance Issue Resolved</h2>
							</a>
						</article>

						<article class="style3">
							<span class="image">
								<img src="images/confirm.png" alt="" height="350" />
							</span>

							<a href="StudentReportToPOSA.php">
								<h2>Report To POSA</h2>
							</a>
						</article>

					
					</section>
                <?php } ?>
            </div>


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