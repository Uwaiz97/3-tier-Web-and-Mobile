<?php
session_start();

include "classes/report-view.classes.php";
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Reports</title>
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
    <style>
        th {
            cursor: pointer;
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
                    <span class="fa fa-home"></span> <span class="title">
                        POSA
                    </span>
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

        <div id="main">
            <br>

            <div class="inner">

                <h2 class="h2">Reports</h2>

                <br>

                <table id="issueTable">
                    <thead>
                        <tr>
                            <th data-col="0">Name</th>
                            <th data-col="1">Reporter</th>
                            <th data-col="2">Reportee Name</th>
                            <th data-col="3">Accommodation</th>
                            <th data-col="4">Student Number</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $reportView = new ReportsView();
                        $reports = $reportView->showAllUnresolvedReports();

                        foreach ($reports as $report) {
                            if ($report["report_reporterStudent"] == true) {
                                $reporter = $reportView->showUser($report["student_id"]);
                                $reporteeId = $reportView->showUser($report["landlord_id"]);
                                $reporterType = "Student";
                            } else {
                                $reporter = $reportView->showUser($report["landlord_id"]);
                                $reportee = $reportView->showUser($report["student_id"]);
                                $reporterType = "Landlord";
                            }
                            $student = $reportView->showStudent($report["student_id"]);
                            $property = $reportView->showProperty($student["prop_id"]);

                            ?>
                            <tr>
                                <td>
                                    <p>
                                        <?php echo $reporter['user_name'] ?>
                                    </p>
                                </td>

                                <td>
                                    <p>
                                        <?php echo $reporterType ?>
                                    </p>
                                </td>

                                <td>
                                    <p>
                                        <?php echo $reportee['user_name'] ?>
                                    </p>
                                </td>

                                <td>
                                    <p>
                                        <?php echo $property['prop_name'] ?>
                                    </p>
                                </td>

                                <td>
                                    <p>
                                        <?php echo $student['student_number'] ?>
                                    </p>
                                </td>

                                <td>
                                    <a href="aboutReport.php?reportid=<?php echo $report['report_id']; ?>"
                                        class="btn btn-info" role="button">View Report</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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