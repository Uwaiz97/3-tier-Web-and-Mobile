<?php
if (isset($_POST["accept"])) {
    //Get Data from form
    $studentId = $_POST["studentId"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/student.classes.php";
    include "../classes/studentConfirm-contr.classes.php";
    $studentContr = new StudentConfirmContr($studentId);

    //Error Handling and then registering
    $studentContr->approveStudent();

    //Going to back to front page
    header("location: ../confirmStudentPage.php?error=none");
}

if (isset($_POST["decline"])) {
    //Get Data from form
    $studentId = $_POST["studentId"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/student.classes.php";
    include "../classes/studentConfirm-contr.classes.php";
    $studentContr = new StudentConfirmContr($studentId);

    //Error Handling and then registering
    $studentContr->declineStudent();

    //Going to back to front page
    header("location: ../confirmStudentPage.php?error=none");
}