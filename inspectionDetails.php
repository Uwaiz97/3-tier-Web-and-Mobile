<?php
session_start();

include "classes/dbh.classes.php";
include "classes/inspection.classes.php";
include "classes/inspection-view.classes.php";

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Inpected List</title>
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
				<li><a href="escalated.php">View Escalated Issues</a></li>
				<li><a href="adminReports.php">View Reported Issues</a></li>
				<li><a href="registerEmployee.php">Register Staff Member</a></li>
				<li><a href="includes/logout.inc.php">Log Out</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">
			<div class="inner">
				</br>
			
					<?php
					$inspection = new InspectionView();
					$inspections = $inspection->showCompletedInspections();

					foreach ($inspections as $insp) {  
						 $property = $inspection->getInspectedProperty($insp['prop_id']) ?>
						<tr>
							<td>
								<?php echo $insp['prop_id']; ?>
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
							<form action="includes/inspection.inc.php" method="post">
								<input type="hidden" name="inspID" value="<?php echo $insp["insp_id"]; ?>">
								<th>
									<input type="submit" name="accept" class="btn btn-info" value="View">
								</th>
							</form>
						</tr>
					<?php } ?>

				</table>
    
				<h2>Co-ordinator Inspector Details:</h2>
				<table>
					<tr>
						<th>Name</th>
					    <th>Email</th>
						<th>ID</th>
                        <th>Occupation Date</th>
					</tr>
                   
					<tr>
						<td>name</td>
						<td>email</td>
						<td>id</td>
						<td>27-09-2023</td>
					</tr>

	        	</table>

                <br>
         <h3>Room Details:</h3>
                <table>
					<tr>
						<th>Items</th>
					    <th>Number of Items</th>
						<th>Total Rating</th>
                        <th>Unusable</th>
					</tr>
                   
                    <tr>
						<th>Sharing Rooms</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
					<tr>
						<th>Single Rooms</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Curtains</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Paper Bins</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
                    <tr>
						<th>BookShelves</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Desks</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Chairs</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Wardrobes</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Heaters</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Study Lamps</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
	        	</table>
 <br>
                <h3>Kitchen Details:</h3>
                <table>
					<tr>
						<th>Items</th>
					    <th>Number of Items</th>
						<th>Total Rating</th>
                        <th>Unusable</th>
					</tr>
                   
                    <tr>
						<th>Stoves</th>
						<td>20(Plates)</td>
						<td>70</td>
						<td>7</td>
					</tr>
					
                    <tr>
						<th>Fridges</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Microwaves</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
                    <tr>
						<th>Lock cupboards</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Lock cupboards shelves</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
	        	</table>

                <br>

                
                <h3>Bathroom Details:</h3>
                <table>
					<tr>
						<th>Items</th>
					    <th>Number of Items</th>
						<th>Total Rating</th>
                        <th>Unusable</th>
					</tr>
                   
                    <tr>
						<th>Toilets</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
					
                    <tr>
						<th>Basins</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Laundry Facilities </th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
                    <tr>
						<th>She Bins</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
	        	</table>
                <br>

                <h2>Occupational Health Safety inspector Details:</h2>
				<table>
					<tr>
						<th>Name</th>
					    <th>Email</th>
						<th>ID</th>
                        <th>Occupation Date</th>
					</tr>
                   
					<tr>
						<td>name</td>
						<td>email</td>
						<td>id</td>
						<td>27-09-2023</td>
					</tr>

	        	</table>
                <br>

                <h3>Health Safety Details:</h3>
                <table>
					<tr>
						<th>Items</th>
					    <th>Number of Items</th>
						<th>Total Rating</th>
                        <th>Unusable</th>
					</tr>
                   
                    <tr>
						<th>Fire Extinguishers</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
					
                    <tr>
						<th>Board Signs</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Exit Doors</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
                    <tr>
						<th>Smoke Detectors</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Fire Blankets</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Fire Alarm</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Emergency Exit Route</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
             

                    <tr>
						<th>Emergency Sign</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Fire Equipment Sign</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>First Aid</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
	        	</table>

<br>
                <h2>Security Inspector Details:</h2>
				<table>
					<tr>
						<th>Name</th>
					    <th>Email</th>
						<th>ID</th>
                        <th>Occupation Date</th>
					</tr>
                   
					<tr>
						<td>name</td>
						<td>email</td>
						<td>id</td>
						<td>27-09-2023</td>
					</tr>

	        	</table>
                <br>

                <h3>Security Details:</h3>
                <table>
					<tr>
						<th>Items</th>
					    <th>Number of Items</th>
						<th>Total Rating</th>
                        <th>Unusable</th>
					</tr>
                   
                    <tr>
						<th>Gate</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>
					
                    <tr>
						<th>CCTV Camera</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Armed Response</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Buglar Proof</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

                    <tr>
						<th>Room Lock</th>
						<td>20</td>
						<td>70</td>
						<td>7</td>
					</tr>

	        	</table>

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