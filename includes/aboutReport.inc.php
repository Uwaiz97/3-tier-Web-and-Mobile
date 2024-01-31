<?php

if (isset($_POST["markAsResolved"])) {
    //Get Data from form
    $reportid = $_POST["reportid"];

    //Instantiate contr class
    include "../classes/aboutReport-contr.classes.php";
    $report = new AboutReportContr($reportid);

    //Error Handling and then registering
    $report->markAsResolved();

    //Going to back to front page
    header("location: ../adminReports.php?error=none");
}