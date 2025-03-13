<?php
// Include the settings.php file to get database credentials
include 'settings.php';

// Check if the logout button was clicked
if (isset($_POST['logout'])) {
    // Delete the user_id cookie
    setcookie('user_id', '', time() - 3600, '/');
    // Redirect to the same page to refresh the state
    header("Location: manage.php");
    exit();
}

// Check if the user has access
if (isset($_COOKIE['user_id']) && $_COOKIE['user_id'] == 0) {
    // Allow access
    echo "Access Granted<br>";

    // Create a connection to the database
    $conn = new mysqli($host, $user, $pwd, $sql_db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to select all data from the application table
    $sql = "SELECT * FROM application";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Street Address</th>
                    <th>Suburb</th>
                    <th>State</th>
                    <th>Postcode</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Skills</th>
                    <th>Other Skills</th>
                    <th>Resume</th>
                </tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["application_id"] . "</td>
                    <td>" . $row["first_name"] . "</td>
                    <td>" . $row["last_name"] . "</td>
                    <td>" . $row["date_of_birth"] . "</td>
                    <td>" . $row["gender"] . "</td>
                    <td>" . $row["street_address"] . "</td>
                    <td>" . $row["suburb"] . "</td>
                    <td>" . $row["state"] . "</td>
                    <td>" . $row["postcode"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["phone"] . "</td>
                    <td>";
            // Define the skills array
            $skillsArray = ["programming", "design", "marketing", "sales", "management", "english", "japanese", "chinese"];
            // Split the skills from the database
            $userSkills = explode(", ", $row["skills"]);
            // Display checkboxes
            foreach ($skillsArray as $skill) {
                $checked = in_array($skill, $userSkills) ? "checked" : "";
                echo "<input type='checkbox' name='skills[]' value='$skill' $checked disabled> $skill<br>";
            }
            echo "</td>
                    <td>" . $row["other_skills"] . "</td>
                    <td>" . $row["resume"] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();

    // Add the logout form
    echo '<form method="post" action="">
            <input type="submit" name="logout" value="Logout">
          </form>';
} else {
    // Deny access
    echo "Access Denied";
}
?>