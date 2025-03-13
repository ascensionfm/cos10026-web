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

    // Define the skills array
    $skillsArray = ["programming", "design", "marketing", "sales", "management", "english", "japanese", "chinese"];

    // Add the filter form
    echo '<form method="get" action="">
            Job Reference: <input type="text" name="job_reference" value="' . (isset($_GET['job_reference']) ? $_GET['job_reference'] : '') . '">
            Skills: <select name="skills">
                <option value="">Select Skill</option>';
    foreach ($skillsArray as $skill) {
        $selected = (isset($_GET['skills']) && $_GET['skills'] == $skill) ? 'selected' : '';
        echo '<option value="' . $skill . '" ' . $selected . '>' . $skill . '</option>';
    }
    echo '</select>
            <input type="submit" value="Filter">
          </form>';

    // Build the SQL query with filters
    $sql = "SELECT * FROM application WHERE 1=1";
    if (isset($_GET['job_reference']) && !empty($_GET['job_reference'])) {
        $job_reference = $conn->real_escape_string($_GET['job_reference']);
        $sql .= " AND job_reference LIKE '%$job_reference%'";
    }
    if (isset($_GET['skills']) && !empty($_GET['skills'])) {
        $skills = $conn->real_escape_string($_GET['skills']);
        $sql .= " AND skills LIKE '%$skills%'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Job Reference</th>
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
                    <th>Photo Path</th>
                    <th>Application Date</th>
                </tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["application_id"] . "</td>
                    <td>" . $row["job_reference"] . "</td>
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
            // Split the skills from the database
            $userSkills = explode(", ", $row["skills"]);
            // Display checkboxes
            foreach ($skillsArray as $skill) {
                $checked = in_array($skill, $userSkills) ? "checked" : "";
                echo "<input type='checkbox' name='skills[]' value='$skill' $checked disabled> $skill<br>";
            }
            echo "</td>
                    <td>" . $row["other_skills"] . "</td>
                    <td>" . $row["photo_path"] . "</td>
                    <td>" . $row["application_date"] . "</td>
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