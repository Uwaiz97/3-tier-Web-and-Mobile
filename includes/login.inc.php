<?php
session_start();

if (isset($_POST["login"])) {

    //Get Data from form
    $email = $_POST["email"];
    $password = $_POST["password"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($email, $password);

    //Error Handling and then registering
    $login->loginUser();

    if($login->loginUser() == "User not found")
    {
        $_SESSION['error'] = "User Not Found";
        header("location: ../index.php?error=usernotfound");
    }

    //Going to back to front page
    $userType = $login->getUserType();
    

    if ($userType == "Student") {
        header("location: ../studentHomePage.php?error=none");
    } elseif ($userType == "Landlord") {
        $login->checkForDecline();
        header("location: ../landlordHome.php?error=none");
    } elseif ($userType == "Staff") {
        $staffType = $login->getStaffType();

        if ($staffType == "Manager") {
            header("location: ../posaAdmin.php?error=none");
        } elseif ($staffType == "Administrator") {
            header("location: ../posaAdmin.php?error=none");
        } elseif ($staffType == "Co-Ordinator") {
            header("location: ../inspectionHome.php?error=none");
        } elseif ($staffType == "OHS") {
            header("location: ../inspectionHome.php?error=none");
        } elseif ($staffType == "Security") {
            header("location: ../inspectionHome.php?error=none");
        }

    }
}

if (isset($_POST["reset"])) {

    //Get Data from form
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    //Instantiate contr class
    include "../classes/reset-contr.classes.php";
    $login = new ResetContr($email, $password, $confirmPassword);

    //Error Handling and then registering
    $login->resetUser();

    //Going to back to front page
    header("location: ../index.php?error=none");
}