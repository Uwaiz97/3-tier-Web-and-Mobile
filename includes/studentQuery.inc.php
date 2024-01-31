<?php

if (isset($_POST["submit"])) {

    //Get Data from form
    $title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
    $priorityLvl = filter_var($_POST["pLevelInput"], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
    $userid = filter_var($_POST["userid"], FILTER_SANITIZE_STRING);
    
    // Define a directory for file uploads.
    $uploadDir = "../../../uploads/";

    // Handle file uploads.
    $filePaths = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png']; // Define allowed file extensions.

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
    include "../classes/student.classes.php";
    include "../classes/studentQuery-contr.classes.php";

    if (empty($filePaths['image'])) {
        $query = new studentQueryContr($userid, $title, $priorityLvl, $description, null);
        $query->makeQuery();
    } else {
        $query = new studentQueryContr($userid, $title, $priorityLvl, $description, $filePaths['image']);
        $query->makeImageQuery($filePaths['image']);
    }

    header("location: ../studentHomePage.php?error=none");

    //Going to back to front page

    // header("location: ../studentReportMaintenanceIssue.php?error=none");
}