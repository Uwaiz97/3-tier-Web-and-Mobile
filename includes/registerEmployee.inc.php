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

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/registerEmployee.classes.php";
    include "../classes/register-contr.classes.php";
    $register = new RegisterContr($name, $surname, $email, $phone, $password, $confirm_password, $userType);

    //Error Handling and then registering
    $register->registerUser();

    //Going to back to front page
    header("location: ../index.php?error=none");
}