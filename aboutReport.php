<?php
session_start();
include "classes/report-view.classes.php";
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>About Report</title>
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
                <?php
                $reportView = new ReportsView();
                $report = $reportView->showReport($_GET["reportid"]);

                if ($report["report_reporterStudent"] == true) {
                    $reporter = $reportView->showUser($report["student_id"]);
                    $reporteeId = $reportView->showUser($report["landlord_id"]);
                    $reporterType = "Student";
                    $reporteeType = "Landlord";
                } else {
                    $reporter = $reportView->showUser($report["landlord_id"]);
                    $reportee = $reportView->showUser($report["student_id"]);
                    $reporterType = "Landlord";
                    $reporteeType = "Student";
                }

                $student = $reportView->showStudent($report["student_id"]);
                $property = $reportView->showProperty($student["prop_id"]);
                ?>

                <h2>Reporter Details:</h2>
                <table>
                    <tr>
                        <th>Reporter Name</th>
                        <th>Reporter Surname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>User Type</th>
                        <?php if ($reporterType == "Student") { ?>
                            <th>Student Number</th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $reporter['user_name']; ?>
                        </td>
                        <td>
                            <?php echo $reporter['user_surname']; ?>
                        </td>
                        <td>
                            <?php echo $reporter['user_email']; ?>
                        </td>
                        <td>
                            <?php echo $reporter['user_phoneNo']; ?>
                        </td>
                        <td>
                            <?php echo $reporterType; ?>
                        </td>
                        <?php if ($reporterType == "Student") { ?>
                            <td>
                                <?php echo $student['student_number'] ?>
                            </td>
                        <?php } ?>
                    </tr>
                </table>

                <h2>Reportee Details:</h2>
                <table>
                    <tr>
                        <th>Reportee Name</th>
                        <th>Reportee Surname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>User Type</th>
                        <?php if ($reporterType == "Landlord") { ?>
                            <th>Student Number</th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $reportee['user_name']; ?>
                        </td>
                        <td>
                            <?php echo $reportee['user_surname']; ?>
                        </td>
                        <td>
                            <?php echo $reportee['user_email']; ?>
                        </td>
                        <td>
                            <?php echo $reportee['user_phoneNo']; ?>
                        </td>
                        <td>
                            <?php echo $reporteeType; ?>
                        </td>
                        <?php if ($reporterType == "Landlord") { ?>
                            <td>
                                <?php echo $student['student_number'] ?>
                            </td>
                        <?php } ?>
                    </tr>
                </table>

                <h2>Accommodation Details:</h2>
                <table>
                    <tr>
                        <th>Accommodation Code</th>
                        <th>Accommodation Name</th>
                        <th>Address Line</th>
                        <th>Number of Beds</th>
                    </tr>
                    
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

                <h2>Report:</h2>

                <div class="info-box">
                    <strong>Title:</strong>
                    <p>
                        <?php echo $report['report_title']; ?>
                    </p>
                    
                    <strong>Date:</strong>
                    <p>
                        <?php echo $report['report_date']; ?>
                    </p>

                    <strong>Description:</strong>
                    <p>
                        <?php echo $report['report_description']; ?>
                    </p>
                </div>

                <form action="includes/aboutReport.inc.php" method="post">
                    <div>
                        <div class="fields">
                            <div class="field text-right">
                                <label>&nbsp;</label>

                                <input type="hidden" name="reportid" value="<?php echo $_GET['reportid']; ?>">

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