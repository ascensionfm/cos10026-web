<?php
//author: Nguyen Khanh Huyen
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
                status VARCHAR(20) NOT NULL DEFAULT 'Pending',
                position_name VARCHAR(100) DEFAULT 'Not specified'
            )";
            
            if (!$conn->query($createTableSQL)) {
                throw new Exception("Error creating table: " . $conn->error);
            }
        }
        
        // Get user_id from session
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
            "BSE01" => "Backend Software Engineer",
            "IPC01" => "IT Project Coordinator",
            "MSIS1" => "Microsoft Infrastructure Specialist",
            "PS001" => "Product Specialist",
            "SAE01" => "Software Application Engineer",
            "SEIM1" => "Software Engineer (Infrastructure Management)",
            "SM001" => "Sales Manager",
            "SSA01" => "System Security Administrator",
            "TPM01" => "Technical Project Manager"
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
        $dbError = "Database operation failed. Please try again later.";
    }
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
    <link rel="stylesheet" href="./styles/style-apply.css">
    <link rel="stylesheet" href="./styles/style-apply-confirmation.css">
</head>
<body>
    <header>
        <div id="navbar" class="obj-width">
            <a href="index.php"><img class="logo" src="images/logo.png" alt="Next_gen logo"></a>
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <ul id="menu">
                <li><a class="navbar_button" href="jobs.php">Jobs</a></li>       
                <li><a class="navbar_button" href="about.php">About</a></li> 
                <li><a class="navbar_button" href="apply.php">Apply</a></li> 
                <li><a class="navbar_button" href="contact.php">Contact</a></li>  
                <li><a class="navbar_button" href="enhancements.php">Enhancements</a></li>       
                <li><a id="w-btn" href="join.php">Join</a></li>   
            </ul>
            <label for="nav-toggle" class="nav-toggle-label">
                <i class='bx bx-menu'></i>
            </label>
        </div>
    </header>

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

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-section">
                    <img class="footer-logo" src="images/logo.png" alt="Next_gen logo">
                    <p>Pioneering the next wave of digital innovation with cutting-edge solutions.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.twitter.com"><i class='bx bxl-twitter'></i></a>
                        <a href="https://www.linkedin.com"><i class='bx bxl-linkedin'></i></a>
                        <a href="https://www.instagram.com"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="jobs.php">Careers</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Projects</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Newsletter</h4>
                    <p>Subscribe to our newsletter for updates</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Enter your email">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Next_Gen Corporation. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>