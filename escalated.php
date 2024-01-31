<?php
session_start();

// include "classes/dbh.classes.php";
// include "classes/student.classes.php";
include "classes/student-view.classes.php";
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Escalated Issues</title>
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
                <li><a href="viewAccommodation.php">View Accommodations</a></li>
                <li><a href="inspectedList.php">View Completed Inspections</a></li>
                <li><a href="escalated.php">View Escalated Issues</a></li>
                <li><a href="adminReports.php">View Reported Issues</a></li>
                <li><a href="stats.php">Stats</a></li>
                <li><a href="registerEmployee.php">Register Staff Member</a></li>
                <li><a href="includes/logout.inc.php">Log Out</a></li>
            </ul>
        </nav>

        <!-- Main -->
        <div id="main">

            <br>
            <br>

            <div class="inner">

                <h2 class="h2">Escalated Issues</h2>

                <br>

                <table id="issueTable">
                    <thead>
                        <tr>
                            <th data-col="0">Accomodation Name</th>
                            <th data-col="1">Landlord Name</th>
                            <th data-col="2">Room Number</th>
                            <th data-col="3">Issue</th>
                            <th data-col="4">Student Name</th>
                            <th data-col="5">Date/Time Logged</th>
                            <th>view</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $studentView = new StudentView();
                        $queries = $studentView->showUnescalatedQueries();

                        foreach ($queries as $query) {
                            $studentView->calcEscalated($query["query_id"]);
                        }

                        $queries = $studentView->showEscalatedQueries();


                        foreach ($queries as $query) {
                            if (!$queries == null) {
                                $property = $studentView->showProperty($query["prop_id"]);
                                $landlord = $studentView->showUser($property['landlord_id']);
                                $student = $studentView->showStudent($query["student_id"]);
                                $userStudent = $studentView->showUser($query["student_id"]);

                                ?>
                                <tr>
                                    <td>
                                        <p>
                                            <?php echo $property['prop_name'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?php echo $landlord['user_name'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?php echo $student['student_roomNo'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?php echo $query['query_title'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?php echo $userStudent['user_name'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?php echo $query['query_date'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <a href="aboutMaintenanceIssue.php?queryid=<?php echo $query['query_id']; ?>"
                                            class="btn btn-info" role="button">View Issue</a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
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
    <script src="assets/js/filterSystem.js"></script>

</body>

</html>