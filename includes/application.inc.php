<?php

if (isset($_POST["submit"])) {

    //Get Data from form
    $propertyName = filter_var($_POST['propertyName'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $numBeds = filter_var($_POST['numBeds'], FILTER_SANITIZE_NUMBER_INT);

    // Define a directory for file uploads.
    $uploadDir = "../../../uploads/";

    // Handle file uploads.
    $filePaths = [];
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx']; // Define allowed file extensions.

    foreach ($_FILES as $key => $file) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Generate a unique filename to avoid overwriting existing files.
        $uniqueFileName = uniqid() . '.' . $fileExtension;

        // Check if the file extension is allowed.
        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadPath = $uploadDir . $uniqueFileName;

            // Move the uploaded file to the designated directory.
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                // Use the same key as in the form input names.
                $filePaths[$key] = $uploadPath;
            }
        }
    }

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/application.classes.php";
    include "../classes/application-contr.classes.php";
    $application = new ApplicationContr($propertyName, $address, $numBeds, $filePaths['companyRegister'], $filePaths['proofOwnership'], $filePaths['taxPin'], $filePaths['utilityBill'], $filePaths['liabilityCover'], $filePaths['certificateOccupancy'], $filePaths['landUseConsent'], $filePaths['zoningPermit'], $filePaths['buildingPlans'], $filePaths['proofOfPayment']);

    //Error Handling and then registering
    $application->applyForAccrediton();

    //Going to back to front page
    header("location: ../applicationPage.php?error=none");
}