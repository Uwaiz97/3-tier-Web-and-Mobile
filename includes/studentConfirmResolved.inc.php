<?php
if (isset($_POST["resolved"])) {
    //Get Data from form
    $queryId = $_POST["queryId"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/student.classes.php";
    include "../classes/studentConfirmResolve-contr.classes.php";
    $studentContr = new StudentConfirmResolveContr($queryId);
    echo "here";

    //Error Handling and then registering
    $studentContr->markAsResolve();

    //Going to back to front page
    header("location: ../viewMaintenanceStatus.php?error=none");
}

if (isset($_POST["unresolved"])) {
    //Get Data from form
    $queryId = $_POST["queryId"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/student.classes.php";
    include "../classes/studentConfirmResolve-contr.classes.php";
    $studentContr = new StudentConfirmResolveContr($queryId);

    //Error Handling and then registering
    $studentContr->markAsUnresolve();

    //Going to back to front page
    header("location: ../viewMaintenanceStatus.php?error=none");
}