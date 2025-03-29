<?php
// settings.php: Database connection settings
$host   = "localhost";
$user   = "root";
$pwd    = "ikon282006"; // set your MySQL password if needed
$sql_db = "job_portal";

// Create connection
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
