<?php
$dbhost = "localhost";
$dbuser = "root";
$dbname = "group_project";
$conn = mysqli_connect($dbhost, $dbuser, "", $dbname);

if(!$conn){
    die("Failed to connect");
}
