<?php

if (isset($_POST["accredit"])) {
    //Get Data from form
    $inspid = $_POST["inspid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/inspection.classes.php";
    include "../classes/aboutInspection-contr.classes.php";
    $application = new AboutInspectionContr($inspid);

    //Error Handling and then registering
    $application->approveInspection();

    //Going to back to front page
    header("location: ../inspectedList.php?error=none");
}

if (isset($_POST["decline"])) {
    //Get Data from form
    $inspid = $_POST["inspid"];
    $declineComment = $_POST["declineComment"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/inspection.classes.php";
    include "../classes/aboutInspection-contr.classes.php";
    $application = new AboutInspectionContr($inspid);

    //Error Handling and then registering
    $application->declineInspection($declineComment);

    //Going to back to front page
    header("location: ../inspectedList.php?error=none");
}