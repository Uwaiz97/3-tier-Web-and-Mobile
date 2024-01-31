<?php
include "classes/studentStats-view.classes.php";
include "classes/propertyStats-view.classes.php";
include "classes/queryStats-view.classes.php";
include "classes/inspectionStats-view.classes.php";
?>
<!DOCTYPE HTML>
<html>

<head>

    <link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="icon">
    <link href="https://www.uj.ac.za/wp-content/uploads/2021/11/university-of-johannesburg.webp" rel="apple-touch-icon">
    <title>Home Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/statisticsTable.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 49%;
            display: inline-block;
        }

        .center {
            margin: auto;
            width: 80%;
            padding: 10px;
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
            <div class="inner">

                <h2 class="h2">Stats</h2>

                <br>

                <select id="codeSelector">
                    <option value="section1">Number Students</option>
                    <option value="section2">Escalated Queries</option>
                    <option value="section3">Inspection</option>
                </select>

                <div id="section1">
                    <table class="statistics-table">
                        <tr>
                            <th>Accommodation Name</th>
                            <th>Number of students</th>
                        </tr>

                        <?php
                        $prop = new PropertyStatsView();
                        $props = $prop->showPropertyStudent();
                        $st = new StudentsStatsView();
                        $count = $st->showStudentAccomodationId();
                        $insp = new InspectionStatsView();

                        //  for debugging
                        // echo "<pre>";
                        // print_r($count);
                        // echo "</pre>";
                        
                        $it = 0;
                        foreach ($props as $property) {
                            $it++;
                            echo "<tr>";
                            echo "<td>{$property}</td>";

                            $countForProperty = isset($count[$it]) ? $count[$it] : 0;
                            echo "<td>{$countForProperty}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>

                <div id="section2" style="display: none;">

                    <?php
                    // Your PHP code to fetch and format data goes here
                    $accommodationData = [];

                    foreach ($props as $property) {
                        $accomSingleData = [];
                        $it++;
                        $accomSingleData[] = $property;
                        $countForQueries = isset($AllQ[$it]) ? $AllQ[$it] : 0;
                        $accomSingleData[] = $countForQueries;
                        $countForEscalated = isset($escalated[$it]) ? $escalated[$it] : 0;
                        $accomSingleData[] = $countForEscalated;
                        $countForAve = isset($AllQ[$it]) ? $AllQ[$it] : 0;

                        if (isset($count[$it])) {
                            $Ave = $countForQueries / $count[$it];
                        } else {
                            $Ave = 0;
                        }
                        $accomSingleData[] = $Ave;
                        $accommodationData[] = $accomSingleData;
                    }?>
                    
                    <div style="width: 70%" class="center">
                        <canvas id="barChart"></canvas>
                    </div>
                    <br>
                    <div style="width: 50%" class="center">
                        <canvas id="pieChart"></canvas>
                    </div>

                    <table class="statistics-table">
                        <tr>
                            <th>Accommodation Name</th>
                            <th>Number of Queries</th>
                            <th>Number of Escalated</th>
                            <th>Average per Student</th>
                        </tr>

                        <?php
                        $prop = new PropertyStatsView();
                        $props = $prop->showPropertyStudent();
                        $quer = new QueryStatsView();
                        $escalated = $quer->showEscalatedQueries();
                        $AllQ = $quer->showAverageQueries();

                        $it = 0;
                        foreach ($props as $property) {

                            $it++; ?>
                            <tr>
                                <td>
                                    <?php echo $property; ?>
                                </td>
                                <?php $countForQueries = isset($AllQ[$it]) ? $AllQ[$it] : 0; ?>
                                <td>
                                    <?php echo $countForQueries; ?>
                                </td>
                                <?php $countForEscalated = isset($escalated[$it]) ? $escalated[$it] : 0 ?>
                                <td>
                                    <?php echo $countForEscalated; ?>
                                </td>
                                <?php $countForAve = isset($AllQ[$it]) ? $AllQ[$it] : 0;

                                if (isset($count[$it])) {
                                    $Ave = $countForQueries / $count[$it];
                                } else {
                                    $Ave = 0;
                                } ?>

                                <td>
                                    <?php echo number_format($Ave, 2, '.', ''); ?>
                                </td>
                            </tr>
                            <?php
                        } ?>
                    </table>
                </div>

                <div id="section3" style="display: none;">
                    <?php
                    $inspectors = $insp->showInspectors();
                    $inspectorData = [];

                    // Your PHP code to fetch and format data goes here
                    foreach ($inspectors as $inspector) {
                        $inspectionSingleData = [];
                        $inspections = $insp->showUserInspections($inspector);
                        $inspDetails = $insp->showUser($inspector);
                        $inspectionSingleData[] = $inspDetails["user_name"];
                        $inspectionSingleData[] = $insp->showthisCompletedInspectionsCount($inspections);

                        $inspectorData[] = $inspectionSingleData;
                    }

                    $inspectionData = [];

                    $inspectionSingleData = [];
                    $inspectionSingleData[] = "Pending";
                    $inspectionSingleData[] = $insp->showAwaitingInspectorsCount();
                    $inspectionData[] = $inspectionSingleData;

                    $inspectionSingleData = [];
                    $inspectionSingleData[] = "Completed";
                    $inspectionSingleData[] = $insp->showCompletedInspectionsCount();
                    $inspectionData[] = $inspectionSingleData;

                    // For example:z
                    // $accommodationData = [
                    //     ['Accommodation A', 20.5, 5.2, 10.3],
                    //     ['Accommodation B', 15.3, 3.8, 7.6],
                    //     // Add more data as needed with float values
                    // ];
                    ?>
                    <div style="width: 70%" class="center">
                        <canvas id="InspectionbarChart"></canvas>
                    </div>
                    <br>
                    <div style="width: 50%" class="center">
                        <canvas id="InspectionpieChart"></canvas>
                    </div>
                </div>
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

    <!-- query script -->
    <script>
        var accommodationData = <?php echo json_encode($accommodationData); ?>;

        // Create a bar chart
        var ctx1 = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: accommodationData.map(data => data[0]),
                datasets: [
                    {
                        label: 'Number of Queries',
                        data: accommodationData.map(data => data[1]),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Number of Escalated Queries',
                        data: accommodationData.map(data => data[2]),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // Create a pie chart with random colors
        var ctx2 = document.getElementById('pieChart').getContext('2d');
        var pieColors = generateRandomColors(accommodationData.length);

        var pieChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: accommodationData.map(data => data[0]),
                datasets: [
                    {
                        data: accommodationData.map(data => data[3]),
                        backgroundColor: pieColors,
                        borderColor: pieColors,
                        borderWidth: 1
                    }
                ]
            }
        });

        // Function to generate random colors
        function generateRandomColors(numColors) {
            var colors = [];
            for (var i = 0; i < numColors; i++) {
                var color = '#' + (Math.random().toString(16) + '000000').slice(2, 8);
                colors.push(color);
            }
            return colors;
        }
    </script>

    <!-- inspection script -->
    <script>
        var inspectorData = <?php echo json_encode($inspectorData); ?>;

        // Create a bar chart
        var ctx3 = document.getElementById('InspectionbarChart').getContext('2d');
        var barChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: inspectorData.map(data => data[0]),
                datasets: [
                    {
                        label: 'Number of completed Inspections',
                        data: inspectorData.map(data => data[1]),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var inspectionData = <?php echo json_encode($inspectionData); ?>;
        // Create a pie chart with random colors
        var ctx4 = document.getElementById('InspectionpieChart').getContext('2d');
        var pieColors = generateRandomColors(inspectionData.length);

        var pieChart = new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: inspectionData.map(data => data[0]),
                datasets: [
                    {
                        data: inspectionData.map(data => data[1]),
                        backgroundColor: pieColors,
                        borderColor: pieColors,
                        borderWidth: 1
                    }
                ]
            }
        });

        // Function to generate random colors
        function generateRandomColors(numColors) {
            var colors = [];
            for (var i = 0; i < numColors; i++) {
                var color = '#' + (Math.random().toString(16) + '000000').slice(2, 8);
                colors.push(color);
            }
            return colors;
        }
    </script>

    <script>
        const codeSelector = document.getElementById('codeSelector');
        const sections = ['section1', 'section2', 'section3'];

        codeSelector.addEventListener('change', function () {
            const selectedSection = codeSelector.value;

            // Hide all sections
            sections.forEach((section) => {
                const sectionElement = document.getElementById(section);
                sectionElement.style.display = 'none';
            });

            // Show the selected section
            const selectedSectionElement = document.getElementById(selectedSection);
            selectedSectionElement.style.display = 'block';
        });
    </script>
</body>

</html>