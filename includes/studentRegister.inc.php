<?php
session_start();

if (isset($_POST["Submit"])) {

//Get Data from form
$code = $_POST["code"];

//Instantiate contr class
include "../classes/dbh.classes.php";
include "../classes/register.classes.php";
include "../classes/studentRegister-contr.classes.php";
$register = new studentRegisterContr($code);

//Error Handling and then registering
$register->registerStudent();

//Going to back to front page
header("location: ../registerEmployee.php?error=none");
}