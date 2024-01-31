<?php

if (isset($_POST["register"])) {

    //Get Data from form
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $userType = $_POST["userType"];
    $studentNo = $_POST["studentNo"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/register.classes.php";
    include "../classes/register-contr.classes.php";
    $register = new RegisterContr($name, $surname, $email, $phone, $password, $confirm_password, $userType, $studentNo);

    //Error Handling and then registering
    $register->registerUser();

    //Going to back to front page
    header("location: ../index.php?error=none");
}

if (isset($_POST["registerStaff"])) {

    //Get Data from form
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $userType = $_POST["userType"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/register.classes.php";
    include "../classes/registerStaff-contr.classes.php";
    $register = new RegisterStaffContr($name, $surname, $email, $phone, $userType);

    //Error Handling and then registering
    $register->registerStaffUser();

    //Going to back to front page
    header("location: ../registerEmployee.php?error=none");
}

if (isset($_POST["registerStudent"])) {

    //Get Data from form
    $prop_id = $_POST["prop_id"];
    $rommNo = $_POST["rommNo"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/register.classes.php";
    include "../classes/registerStudent-contr.classes.php";
    $register = new RegisterStudentContr($prop_id, $rommNo);

    //Error Handling and then registering
    $register->linkStudentUser();

    //Going to back to front page
    header("location: ../studentHomePage.php?error=none");
}

if (isset($_POST["registerCaretaker"])) {

    //Get Data from form
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/register.classes.php";
    include "../classes/registerCaretaker-contr.classes.php";
    $register = new RegisterCaretakerContr($name, $surname, $email, $phone);

    //Error Handling and then registering
    $register->registerCaretaker();

    //Going to back to front page
    header("location: ../studentHomePage.php?error=none");
}