<?php
session_start();
include "classes/dbh.classes.php";
include "classes/application.classes.php";
include "classes/application-view.classes.php";
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Accredited List</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/en/thumb/a/af/University_of_Johannesburg_Logo.svg/1200px-University_of_Johannesburg_Logo.svg.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/custom.css"> <!-- Custom CSS -->
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
        <header id="header" class="alt">
            <div class="inner">

                <!-- Logo -->
                <a href="posaAdmin.php" class="logo">
                    <span class="title"><strong>POSA</strong></span>
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
                <li><a href="includes/logout.inc.php">Log Out</a></li>
            </ul>
        </nav>

        <!-- Main -->
        <div id="main">

            <br>
            <br>

            <div class="inner">
                <br>
                <h1 class="h2">Accredited Student Accommodations:</h1>
                <br>
                <table id="issueTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Accommodation Name</th>
                            <th>Address</th>
                            <th>Register</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add your PHP code to populate the table here -->
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
