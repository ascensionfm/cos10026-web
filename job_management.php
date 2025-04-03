<?php
// Include the settings file to get database credentials
require_once 'settings.php';

// Establish a connection to the database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch all columns from the jobs table
$query = "SELECT * FROM jobs";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<table border='1'>";
    echo "<tr>";
    
    // Fetch and display column names
    while ($field = mysqli_fetch_field($result)) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";
    
    // Fetch and display rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
