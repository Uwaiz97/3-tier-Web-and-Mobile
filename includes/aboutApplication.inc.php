<?php

if (isset($_POST["updateToInspect"])) {
    //Get Data from form
    $propid = $_POST["propid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/application.classes.php";
    include "../classes/aboutApplication-contr.classes.php";
    $application = new AboutApplicationContr($propid);

    //Error Handling and then registering
    $application->sendToInspection();

    //Going to back to front page
    header("location: ../applicationHandler.php?error=none");
}

if (isset($_POST["declineApplication"])) {
    //Get Data from form
    $propid = $_POST["propid"];
    $declineComment = $_POST["declineComment"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/application.classes.php";
    include "../classes/aboutApplication-contr.classes.php";
    $application = new AboutApplicationContr($propid);

    //Error Handling and then registering
    $application->declineApplication($declineComment);

    //Going to back to front page
    header("location: ../applicationHandler.php?error=none");
}

if (isset($_POST["deAccredited"])) {
    //Get Data from form
    $propid = $_POST["propid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/application.classes.php";
    include "../classes/aboutApplication-contr.classes.php";
    $application = new AboutApplicationContr($propid);

    //Error Handling and then registering
    $application->deAccreditProperty();

    //Going to back to front page
    header("location: ../viewAccommodation.php?error=none");
}

if (isset($_POST["allowAccreditation"])) {
    //Get Data from form
    $propid = $_POST["propid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/application.classes.php";
    include "../classes/aboutApplication-contr.classes.php";
    $application = new AboutApplicationContr($propid);

    //Error Handling and then registering
    $application->allowAccreditation();

    //Going to back to front page
    header("location: ../viewAccommodation.php?error=none");
}