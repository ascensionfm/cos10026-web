<?php
$servername = "localhost";
$username = "ascensionfm_";
$password = "AscensionFM123";
$dbname = "ascensionfm_";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>