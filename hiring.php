<?php
session_start();
// Ensure the management_loggedin variable is set and true
if (!isset($_SESSION['management_loggedin']) || $_SESSION['management_loggedin'] !== true) {
    header('Location: Mana_log.php');
    exit;
}

// Your page content goes here
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jobs Opening - Next_Gen Corporation</title>
        <link rel="icon" href="./images/logo1.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="styles/style-apply.css">
        <link rel="stylesheet" href="styles/after-login.css">
        <link rel="stylesheet" href="styles/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <?php require("header.inc"); ?>
        <?php
        // Database connection
        require_once("settings.php");

        $conn = new mysqli($host, $user, $pwd, $sql_db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL to create table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS jobs (
            job_reference CHAR(5) PRIMARY KEY,
            skills TEXT,
            description TEXT,
            level TEXT,
            type TEXT,
            location TEXT,
            salary_min INT,
            salary_max INT
        )";

        $conn->query($sql);

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $job_reference = htmlspecialchars($conn->real_escape_string($_POST['job_reference']));
            $skills = isset($_POST['skills']) ? implode(", ", array_map('htmlspecialchars', $_POST['skills'])) : '';
            $skills = $conn->real_escape_string($skills);
            $description = htmlspecialchars($conn->real_escape_string($_POST['description']));
            $level = htmlspecialchars($conn->real_escape_string($_POST['level']));
            $type = htmlspecialchars($conn->real_escape_string($_POST['type']));
            $location = htmlspecialchars($conn->real_escape_string($_POST['location']));
            $salary_min = htmlspecialchars((int)$_POST['salary_min']);
            $salary_max = htmlspecialchars((int)$_POST['salary_max']);

            // Insert data into the table
            $insert_sql = "INSERT INTO jobs (job_reference, skills, description, level, type, location, salary_min, salary_max) 
                   VALUES ('$job_reference', '$skills', '$description', '$level', '$type', '$location', $salary_min, $salary_max)";
            $conn->query($insert_sql);
        }

        // Display the form
        echo '<form method="POST" action="" style="max-width: 600px; margin: 2rem auto; padding: 2rem; background: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <label for="job_reference" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Job Reference:</label>
            <input type="text" id="job_reference" name="job_reference" required style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px;"><br>

            <label for="skills" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Skills:</label><br>
            <div style="margin-bottom: 1rem;">
            <input type="checkbox" id="programming" name="skills[]" value="Programming">
            <label for="programming" style="margin-right: 1rem;">Programming</label>
            <input type="checkbox" id="design" name="skills[]" value="Design">
            <label for="design" style="margin-right: 1rem;">Design</label>
            <input type="checkbox" id="marketing" name="skills[]" value="Marketing">
            <label for="marketing" style="margin-right: 1rem;">Marketing</label>
            <input type="checkbox" id="sales" name="skills[]" value="Sales">
            <label for="sales" style="margin-right: 1rem;">Sales</label>
            <input type="checkbox" id="management" name="skills[]" value="Management">
            <label for="management" style="margin-right: 1rem;">Management</label>
            <input type="checkbox" id="english" name="skills[]" value="English">
            <label for="english" style="margin-right: 1rem;">English</label>
            <input type="checkbox" id="japanese" name="skills[]" value="Japanese">
            <label for="japanese" style="margin-right: 1rem;">Japanese</label>
            <input type="checkbox" id="chinese" name="skills[]" value="Chinese">
            <label for="chinese" style="margin-right: 1rem;">Chinese</label>
            <input type="checkbox" id="other" name="skills[]" value="Other">
            <label for="other" style="margin-right: 1rem;">Other</label>
            </div>

            <label for="description" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Description:</label>
            <textarea id="description" name="description" required style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px;"></textarea><br>

            <label for="level" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Level:</label>
            <input type="text" id="level" name="level" required style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px;"><br>

            <label for="type" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Type:</label>
            <input type="text" id="type" name="type" required style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px;"><br>

            <label for="location" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Location:</label>
            <input type="text" id="location" name="location" required style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px;"><br>

            <label for="salary_min" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Minimum Salary:</label>
            <input type="number" id="salary_min" name="salary_min" required style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px;"><br>

            <label for="salary_max" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Maximum Salary:</label>
            <input type="number" id="salary_max" name="salary_max" required style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px;"><br>

            <button type="submit" style="display: block; width: 100%; padding: 0.75rem; background: #1f3e5d; color: #fff; border: none; border-radius: 4px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.3s;">
            Add Job
            </button>
        </form>';
        $conn->close();
        ?>
        <?php require("footer.inc"); ?>
    </body>
</html>