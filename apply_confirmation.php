<?php
//author: Nguyen Khanh Huyen (Input verification and sanitization code made by Nguyen Quy Vuong)
// filename: apply_confirmation.php
// created: 06/03/25
// description: Backend script to process job application data and display as CV

// Include database settings
require_once("settings.php");

// Initialize variables to store form data
$jobReference = $firstName = $lastName = $dateOfBirth = $gender = "";
$streetAddress = $suburb = $state = $postcode = $email = $phone = "";
$skills = $otherSkills = $photoPath = $resumePath = "";
$uploadError = "";
$dbError = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $jobReference = isset($_POST["job-reference"]) ? htmlspecialchars($_POST["job-reference"]) : "";
    $firstName = isset($_POST["first-name"]) ? htmlspecialchars($_POST["first-name"]) : "";
    $lastName = isset($_POST["last-name"]) ? htmlspecialchars($_POST["last-name"]) : "";
    $dateOfBirth = isset($_POST["date-of-birth"]) ? htmlspecialchars($_POST["date-of-birth"]) : "";
    $gender = isset($_POST["gender"]) ? htmlspecialchars($_POST["gender"]) : "";
    $streetAddress = isset($_POST["street-address"]) ? htmlspecialchars($_POST["street-address"]) : "";
    $suburb = isset($_POST["suburb"]) ? htmlspecialchars($_POST["suburb"]) : "";
    $state = isset($_POST["state"]) ? htmlspecialchars($_POST["state"]) : "";
    $postcode = isset($_POST["postcode"]) ? htmlspecialchars($_POST["postcode"]) : "";
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
    $phone = isset($_POST["phone"]) ? htmlspecialchars($_POST["phone"]) : "";
      // Validate Job Reference Number
      if (empty($_POST["job-reference"]) || !preg_match("/^[a-zA-Z0-9]{5}$/", $_POST["job-reference"])) {
        $errors[] = "Job Reference Number must be exactly 5 alphanumeric characters.";
      }
  
      // Validate First Name
      if (empty($_POST["first-name"]) || !preg_match("/^[A-Za-z]{1,20}$/", $_POST["first-name"])) {
        $errors[] = "First Name must be 1-20 alphabetic characters.";
      }
  
      // Validate Last Name
      if (empty($_POST["last-name"]) || !preg_match("/^[A-Za-z]{1,20}$/", $_POST["last-name"])) {
        $errors[] = "Last Name must be 1-20 alphabetic characters.";
      }
  
      // Validate Date of Birth
    if (empty($_POST["date-of-birth"])) {
      $errors[] = "Date of Birth is required.";
    } else {
      $dateOfBirth = $_POST["date-of-birth"];
      $dobTimestamp = strtotime($dateOfBirth);
      $currentTimestamp = time();
      $age = ($currentTimestamp - $dobTimestamp) / (365.25 * 24 * 60 * 60);

      if ($age < 15 || $age > 80) {
        $errors[] = "Age must be between 15 and 80 years.";
      }
    }
  
      // Validate Gender
      if (empty($_POST["gender"]) || !in_array($_POST["gender"], ["male", "female", "other"])) {
        $errors[] = "Please select a valid gender.";
      }
  
      // Validate Street Address
      if (empty($_POST["street-address"]) || strlen($_POST["street-address"]) > 40) {
        $errors[] = "Street Address must not exceed 40 characters.";
      }
  
      // Validate Suburb
      if (empty($_POST["suburb"]) || strlen($_POST["suburb"]) > 40) {
        $errors[] = "Suburb/Town must not exceed 40 characters.";
      }
  
      // Validate State
      $validStates = ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"];
      if (empty($_POST["state"]) || !in_array($_POST["state"], $validStates)) {
        $errors[] = "Please select a valid state.";
      }
  
      // Validate Postcode
      $statePostcodeRanges = [
        "NSW" => [[1000, 1999], [2000, 2599], [2619, 2899], [2921, 2999]],
        "ACT" => [[200, 299], [2600, 2618], [2900, 2920]],
        "VIC" => [[3000, 3999], [8000, 8999]],
        "QLD" => [[4000, 4999], [9000, 9999]],
        "SA" => [[5000, 5799], [5800, 5999]],
        "WA" => [[6000, 6797], [6800, 6999]],
        "TAS" => [[7000, 7799], [7800, 7999]],
        "NT" => [[800, 899], [900, 999]],
      ];
  
      if (empty($_POST["postcode"]) || !preg_match("/^[0-9]{4}$/", $_POST["postcode"])) {
        $errors[] = "Postcode must be exactly 4 digits.";
      } else {
        $postcode = (int)$_POST["postcode"];
        $state = $_POST["state"];
        $validPostcode = false;
  
        if (isset($statePostcodeRanges[$state])) {
          foreach ($statePostcodeRanges[$state] as $range) {
            if ($postcode >= $range[0] && $postcode <= $range[1]) {
              $validPostcode = true;
              break;
            }
          }
        }
  
        if (!$validPostcode) {
          $errors[] = "Postcode does not match the selected state.";
        }
      }
  
      // Validate Email
      if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
      }
  
      // Validate Phone Number
      if (empty($_POST["phone"]) || !preg_match("/^[0-9 ]{8,12}$/", $_POST["phone"])) {
        $errors[] = "Phone Number must be 8-12 digits, spaces allowed.";
      }
  
      // Validate Skills
      if (empty($_POST["skills"])) {
        $errors[] = "Please select at least one skill.";
      }
    // Validate Other Skills
    if (isset($_POST["skills"]) && strpos(implode(", ", $_POST["skills"]), "Other") !== false) {
        if (empty($_POST["other-skills"])) {
            $errors[] = "Please specify your other skills.";
        }
    }
      // If there are errors, display them
      if (!empty($errors)) {
        echo '<div class="error-messages"><ul>';
        foreach ($errors as $error) {
          session_start();
          $_SESSION['errors'] = $errors;
          header("Location: apply.php");
          exit();
        }
      } 
    }
    // Process skills as array
    $skillsArray = isset($_POST["skills"]) ? $_POST["skills"] : array();
    $skills = implode(", ", $skillsArray);
    $otherSkills = isset($_POST["other-skills"]) ? htmlspecialchars($_POST["other-skills"]) : "";

    // Create upload directory if it doesn't exist
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle photo upload
    $photoPath = "images/placeholder-photo.png"; // Default placeholder
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $uploadedType = $_FILES["image"]["type"];
        
        if (in_array($uploadedType, $allowedTypes)) {
            $fileName = time() . "_" . basename($_FILES["image"]["name"]);
            $targetFilePath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $photoPath = $targetFilePath;
            } else {
                $uploadError .= "Failed to upload photo. ";
            }
        } else {
            $uploadError .= "Invalid photo format. Allowed types: JPG, PNG, GIF. ";
        }
    }
    
    // Connect and store to database
    try {
        // Verify database settings are available
        if (!isset($host) || !isset($user) || !isset($pwd) || !isset($sql_db)) {
            throw new Exception("Database configuration is incomplete. Check settings.php file.");
        }
        
        // Create connection with error reporting suppressed to handle it our way
        $conn = @new mysqli($host, $user, $pwd, $sql_db);
        
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        // Check if table exists, create it if not
        $checkTableSQL = "SHOW TABLES LIKE 'applications'";
        $result = $conn->query($checkTableSQL);
        
        if ($result->num_rows == 0) {
            // Table doesn't exist, create it
            $createTableSQL = "CREATE TABLE applications (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                job_reference VARCHAR(50) NOT NULL,
                first_name VARCHAR(50) NOT NULL,
                last_name VARCHAR(50) NOT NULL,
                date_of_birth DATE,
                gender VARCHAR(20),
                street_address VARCHAR(100),
                suburb VARCHAR(50),
                state VARCHAR(30),
                postcode VARCHAR(10),
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(20),
                skills VARCHAR(255),
                other_skills TEXT,
                photo_path VARCHAR(255),
                application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                status VARCHAR(20) NOT NULL DEFAULT 'Submitted',
                position_name VARCHAR(100) DEFAULT 'Not specified'
            )";
            
            if (!$conn->query($createTableSQL)) {
                throw new Exception("Error creating table: " . $conn->error);
            }
        }
        
        // Get user_id from session
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user_id is set in the session
        if (!isset($_SESSION["user_id"])) {
            throw new Exception("User ID is not set. Please log in to submit your application.");
        }

        $user_id = $_SESSION["user_id"];
        
        // Query to insert into database
        $sql = "INSERT INTO applications (user_id, job_reference, first_name, last_name, date_of_birth, gender, 
                street_address, suburb, state, postcode, email, phone, skills, other_skills, photo_path) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("issssssssssssss", $user_id, $jobReference, $firstName, $lastName, $dateOfBirth, $gender,
                         $streetAddress, $suburb, $state, $postcode, $email, $phone, $skills, $otherSkills, $photoPath);
        
        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        // Update position name based on job reference if possible
        $position_name = "Not specified";
        
        // Map of job references to position names
        $job_positions = [
            "00009" => "Backend Software Engineer",
            "00006" => "Intern Project Coordinator",
            "00008" => "Mid/Senior International Sales",
            "00007" => "Production Support",
            "00003" => "Senior AI Engineer",
            "00001" => "Sales Executive (International Market)",
            "00002" => "Sales Manager",
            "00005" => "Senior Solutions Architect / Consultant",
            "00004" => "Technical Project Manager"
        ];
        
        // Check if we have a position name for this job reference
        if (array_key_exists($jobReference, $job_positions)) {
            $position_name = $job_positions[$jobReference];
            
            // Update the position_name in the database
            $update_sql = "UPDATE applications SET position_name = ? WHERE job_reference = ? AND user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            
            if ($update_stmt) {
                $update_stmt->bind_param("ssi", $position_name, $jobReference, $user_id);
                $update_stmt->execute();
                $update_stmt->close();
            }
        }
        
        // Close statement and connection
        $stmt->close();
        $conn->close();
        
    } catch (Exception $e) {
        $dbError = "Database operation failed: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Confirmation - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/style-apply-confirmation.css">
</head>
<body>
    <?php require("header.inc"); ?>

    <main class="main-content">
        <div class="container">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <?php if (!empty($dbError) || !empty($uploadError)): ?>
                    <div class="error-alert">
                        <h3>Warning:</h3>
                        <?php if (!empty($uploadError)): ?>
                            <p><?php echo $uploadError; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($dbError)): ?>
                            <p><?php echo $dbError; ?></p>
                        <?php endif; ?>
                        <p>Your application is displayed below but might not have been saved correctly.</p>
                    </div>
                <?php endif; ?>

                <div class="confirmation-message">
                    <h2>Application Submitted Successfully!</h2>
                    <p>Your application for job reference <strong><?php echo $jobReference; ?></strong> has been received.</p>
                    <p>Below is a summary of your application in CV format:</p>
                </div>

                <div class="cv-container">
                    <div class="cv-header">
                        <div class="cv-photo">
                            <img src="<?php echo $photoPath; ?>" alt="Applicant Photo">
                        </div>
                        <div class="cv-name">
                            <h1><?php echo $firstName . " " . $lastName; ?></h1>
                            <p class="job-reference">Job Reference: <?php echo $jobReference; ?></p>
                        </div>
                    </div>

                    <div class="cv-contact">
                        <div class="contact-item">
                            <i class='bx bx-envelope'></i>
                            <span><?php echo $email; ?></span>
                        </div>
                        <div class="contact-item">
                            <i class='bx bx-phone'></i>
                            <span><?php echo $phone; ?></span>
                        </div>
                        <div class="contact-item">
                            <i class='bx bx-map'></i>
                            <span><?php echo $streetAddress . ", " . $suburb . ", " . $state . " " . $postcode; ?></span>
                        </div>
                    </div>

                    <div class="cv-section">
                        <h2>Personal Information</h2>
                        <div class="cv-info">
                            <div class="info-item">
                                <h3>Date of Birth</h3>
                                <p><?php echo $dateOfBirth; ?></p>
                            </div>
                            <div class="info-item">
                                <h3>Gender</h3>
                                <p><?php echo ucfirst($gender); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="cv-section">
                        <h2>Skills</h2>
                        <div class="skills-container">
                            <?php if (!empty($skills)): ?>
                                <div class="skill-tags">
                                    <?php 
                                    $skillsArr = explode(", ", $skills);
                                    foreach ($skillsArr as $skill): 
                                    ?>
                                        <span class="skill-tag"><?php echo ucfirst($skill); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($otherSkills)): ?>
                                <div class="other-skills">
                                    <h3>Additional Skills</h3>
                                    <p><?php echo $otherSkills; ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="apply.php" class="btn">Back to Application Form</a>
                    <a href="index.php" class="btn btn-home">Go to Homepage</a>
                </div>
            <?php else: ?>
                <div class="error-container">
                    <h2>No Application Data</h2>
                    <p>No application data was submitted. Please fill out the application form first.</p>
                    <div class="action-buttons">
                        <a href="apply.php" class="btn">Go to Application Form</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php require("footer.inc"); ?>
</body>
</html>
