<?php
// Establish a database connection (replace with your actual credentials)
$connection = mysqli_connect("localhost", "root", "","posasystem");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query the database to retrieve a single image (for example, the latest image)
$sql = "SELECT query_image FROM maintenancequery";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imageData = $row['query_image'];

    // Set appropriate content-type header
    header("Content-type: image/*");

    // Output the image data
    echo $imageData;
} else {
    echo "Image not found";
}

// Close the database connection
mysqli_close($connection);
?>
