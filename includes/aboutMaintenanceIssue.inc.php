<?php

if (isset($_POST["markAsResolved"])) {
    //Get Data from form
    $queryid = $_POST["queryid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/student.classes.php";
    include "../classes/studentMaintenanceIssue-contr.classes.php";
    $studenttMaintenanceIssue = new StudentMaintenanceIssueContr($queryid);

    //Error Handling and then registering
    $studenttMaintenanceIssue->markAsResolved();

    //Going to back to front page
    header("location: ../maintenanceIssues.php?error=none");
}