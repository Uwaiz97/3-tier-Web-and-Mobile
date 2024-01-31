<?php

if (isset($_POST["submitLandlordReport"])) {

    //Get Data from form
    $title = $_POST["title"];
    $studentNo = $_POST["studentNo"];
    $description = $_POST["description"];

    //Instantiate contr class
    include "../classes/report-contr.classes.php";
    $report = new ReportContr($title, $description);

    //Error Handling and then registering
    $report->submitLandlordReport($studentNo);

    //Going to back to front page
    header("location: ../landlordHome.php?error=none");
}

if (isset($_POST["submitStudentReport"])) {

    //Get Data from form
    $title = $_POST["title"];
    $description = $_POST["description"];

    //Instantiate contr class
    include "../classes/report-contr.classes.php";
    $report = new ReportContr($title, $description);

    //Error Handling and then registering
    $report->submitStudentReport();

    //Going to back to front page
    header("location: ../studentHomePage.php?error=none");
}