<?php
session_start();

include "classes/student-view.classes.php";
$userid = $_SESSION["userId"];

$studentView = new StudentView();
$user = $studentView->showUser($userid);
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>About Maintenance Issues</title>
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
				<?php if ($user["user_type"] == "Landlord") { ?>
					<a href="landlordHome.php" class="logo">
					<?php } elseif ($user["user_type"] == "Staff") { ?>
						<a href="posaAdmin.php" class="logo">
						<?php } ?>
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

				<li>
					<a href="#" class="dropdown-toggle">Students</a>

					<ul>
						<li><a href="confirmStudentPage.php">Confirm Students</a></li>
						<li><a href="maintenanceIssues.php">View Maintenance Issues</a></li>
						<li><a href="reportPage.php">Report Student</a></li>
					</ul>
				</li>
				<li><a href="#">View Accomadations</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>


		<!-- Main -->
		<div id="main">
			<div class="inner">
				</br>
				<h2>Accommodation Details:</h2>
				<table>
					<tr>
						<th>Accommodation Code</th>
						<th>Accommodation Name</th>
						<th>Address Line</th>
						<th>Number of Beds</th>
					</tr>
					<?php
					$query = $studentView->showQuery($_GET["queryid"]);

					$image_path = $query["query_image"];
					$property = $studentView->showProperty($query["prop_id"]);

					function generateDownloadLink($filePath)
					{
						return "<a href='$filePath' target='_blank'>View Image</a>";
					}

					?>
					<tr>
						<td>
							<?php echo $property['prop_id']; ?>
						</td>
						<td>
							<?php echo $property['prop_name']; ?>
						</td>
						<td>
							<?php echo $property['prop_address']; ?>
						</td>
						<td>
							<?php echo $property['prop_numBeds']; ?>
						</td>
					</tr>
				</table>

				<h2>Student Query Details:</h2>
				<table>
					<tr>
						<th>Student Name</th>
						<th>Room No</th>
						<th>Email</th>
						<th></th>
					</tr>
					<?php $student = $studentView->showStudent($query["student_id"]);
					$user = $studentView->showUser($query["student_id"]); ?>
					<tr>
						<td>
							<?php echo $user['user_name']; ?>
						</td>
						<td>
							<?php echo $student['student_roomNo']; ?>
						</td>
						<td>
							<?php echo $user['user_email']; ?>
						</td>
						<th></th>
					</tr>

				</table>

				<h2>Query Description:</h2>

				<div class="info-box">
					<strong>Title:</strong>
					<p>
						<?php echo $query['query_title']; ?>
					</p>

					<strong>Query Date:</strong>
					<p>
						<?php echo $query['query_date']; ?>
					</p>

					<strong>Priority:</strong>
					<p>
						<?php echo $query['query_priorityLvl']; ?>
					</p>

					<strong>Description:</strong>
					<p>
						<?php echo $query['query_description']; ?>
					</p>
				</div>
				<div class="info-box">
					<strong>Image:</strong>
					<p>
						<?php
						$temp = explode("/", $query['query_image']);
						unset($temp[0]);
						$result = implode("/", $temp);
						echo generateDownloadLink($result); ?>
					</p>
				</div>


				<form action="includes/aboutMaintenanceIssue.inc.php" method="post">
					<div>

						<div class="fields">
							<div class="field text-right">
								<label>&nbsp;</label>

								<input type="hidden" name="queryid" value="<?php echo $_GET['queryid']; ?>">

								<ul class="actions">
									<li><input type="submit" name="markAsResolved" value="Mark as Resolved"
											class="primary" />
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

</html>