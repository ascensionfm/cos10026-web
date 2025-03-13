<?php
	// filename: after_login.php
    // author: Nguyen Khanh Huyen
    // created: 13/3/2025
	// description: Page displaying user information after successful login
?>

<?php
    session_start();
    
    // Check if user is logged in
    if (!isset($_SESSION["user_id"])) {
        // User is not logged in, redirect to login page
        header("Location: join.php");
        exit();
    }
    
    // Create the database connection
    require_once("./settings.php");
    $connection = mysqli_connect($host, $user, $pwd, $sql_db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles/style-apply.css">
    <link rel="stylesheet" href="styles/after-login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                <li><a id="w-btn" href="after_login.php"><i class='bx bx-user'></i></a></li> 
            </ul>
            <label for="nav-toggle" class="nav-toggle-label">
                <i class='bx bx-menu'></i>
            </label>
        </div>
    </header>
    
    <main class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
                <p>Manage your profile and view your application history</p>
            </div>
            
            <div class="profile-content">
                <div class="profile-section">
                    <h2>Personal Information</h2>
                    <p><i class='bx bx-user'></i> <strong>Username:</strong> <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    <p><i class='bx bx-envelope'></i> <strong>Email:</strong> <?php echo htmlspecialchars($_SESSION["user_email"]); ?></p>
                    <!-- Edit Profile button is currently disabled as the functionality is not implemented yet -->
                    <p><i class='bx bx-info-circle'></i> <strong>Note:</strong> Edit Profile functionality coming soon</p>
                    <a href="user_logout.php" class="btn">Log out</a>
                </div>
                
                <div class="profile-section">
                    <h2>Account Settings</h2>
                    <p><i class='bx bx-shield'></i> <strong>Account Security</strong></p>
                    <p>Manage your password and account security settings</p>
                    <a href="reset_password.php" class="btn">Change Password</a>
                </div>
            </div>
            
            <div class="application-history">
                <h2>Application History</h2>
                <?php
                if (!$connection) {
                    echo '<div class="application-card">';
                    echo '<p>Unable to retrieve your application history at this time.</p>';
                    echo '<p>Please try again later.</p>';
                    echo '</div>';
                } else {
                    // Check if applications table exists
                    $table_check_query = "SHOW TABLES LIKE 'applications'";
                    $table_check_result = mysqli_query($connection, $table_check_query);
                    
                    if (mysqli_num_rows($table_check_result) != 1) {
                        // Table doesn't exist
                        mysqli_free_result($table_check_result);
                        echo '<div class="application-card">';
                        echo '<p>You haven\'t submitted any job applications yet.</p>';
                        echo '<p>Browse available positions and apply today!</p>';
                        echo '<a href="jobs.php" class="btn">View Jobs</a>';
                        echo '</div>';
                    } else {
                        // Table exists, fetch applications for this user
                        $user_id = $_SESSION["user_id"];
                        $query = "SELECT * FROM applications WHERE user_id = '$user_id' ORDER BY application_date DESC LIMIT 5";
                        $result = mysqli_query($connection, $query);
                        
                        if ($result && mysqli_num_rows($result) > 0) {
                            // Display applications
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="application-card">';
                                
                                // Get position name or use job reference if not available
                                $position_name = isset($row["position_name"]) && !empty($row["position_name"]) 
                                    ? $row["position_name"] 
                                    : "Job Reference: " . $row["job_reference"];
                                
                                echo '<h3>' . htmlspecialchars($position_name) . '</h3>';
                                echo '<p><strong>Job Reference:</strong> ' . htmlspecialchars($row["job_reference"]) . '</p>';
                                
                                // Format date for better readability - handle both TIMESTAMP and DATETIME formats
                                $date_str = $row["application_date"];
                                if (strpos($date_str, '-') !== false) {
                                    // It's a datetime format
                                    $date = date("M j Y H:i:s", strtotime($date_str));
                                } else {
                                    // It's a timestamp
                                    $date = date("M j Y H:i:s", $date_str);
                                }
                                echo '<p><strong>Applied on:</strong> ' . $date . '</p>';
                                
                                // Display status with appropriate styling
                                $status = isset($row["status"]) ? $row["status"] : "Pending";
                                $status_class = "";
                                
                                if ($status == "Pending") {
                                    $status_class = "pending";
                                } else if ($status == "Approved") {
                                    $status_class = "approved";
                                } else if ($status == "Rejected") {
                                    $status_class = "rejected";
                                }
                                
                                echo '<p><strong>Status:</strong> <span class="status ' . $status_class . '">' . htmlspecialchars($status) . '</span></p>';
                                echo '</div>';
                            }
                            
                            mysqli_free_result($result);
                        } else {
                            // No applications found
                            echo '<div class="application-card">';
                            echo '<p>You haven\'t submitted any job applications yet.</p>';
                            echo '<p>Browse available positions and apply today!</p>';
                            echo '<a href="jobs.php" class="btn">View Jobs</a>';
                            echo '</div>';
                        }
                    }
                    
                    mysqli_close($connection);
                }
                ?>
            </div>
        </div>
    </main>
    
    <!--Footer-->
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