<?php
	// filename: process_reset_password.php
	// author: Nguyen Khanh Huyen
	// created: 088/03/25
	// description: Script processing user requests to reset password. Provides feedback if the password reset is successful.
?>

<?php
    require 'password.php';
    // Check if required inputs are available. The submit input is to prevent direct access.
    if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["password_cf"]) || !isset($_POST["submit"])) {
        header("Location: reset_password.php");
        die();
    }

    // Sanitize the inputs.
    function sanitize($data) {
        return stripslashes(trim($data));
    }

    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    $password_cf = sanitize($_POST["password_cf"]);

    session_start();
    // Store the entered information into the session to reuse it when the user has to
    // resubmit the form.
    $_SESSION["reset_password_email"] = $email;

    // Create an array for errors.
    $errors = array();

    if (!preg_match("/^[a-zA-Z0-9@]{10,}$/i", $password)) {
        array_push($errors, "password=false");
    }
    if ($password != $password_cf) {
        array_push($errors, "password_cf=false");
    }

    // If there is an error, redirect to reset password page.
    if (count($errors) != 0) {
        header("Location: reset_password.php?" . implode("&", $errors));
        die();
    }

    // Create the database connection.
    require_once("./settings.php");
    $connection = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$connection) {
        mysqli_close($connection);
        header("Location: reset_password.php?error=serverError");
        die();
    } else {
        // Check if the users table exists. If not, create it.
        $table_check_query = "SHOW TABLES LIKE 'users'";
        $table_check_result = mysqli_query($connection, $table_check_query);
        if (mysqli_num_rows($table_check_result) != 1) {
            mysqli_free_result($table_check_result);
            $table_create_query = "CREATE TABLE users (
                                    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    first_name VARCHAR(25) NOT NULL,
                                    last_name VARCHAR(25) NOT NULL,
                                    email TEXT NOT NULL,
                                    phone VARCHAR(10) NOT NULL,
                                    street_address VARCHAR(40) NOT NULL,
                                    suburb VARCHAR(20) NOT NULL,
                                    state VARCHAR(20) NOT NULL,
                                    postcode VARCHAR(4) NOT NULL,
                                    password TEXT NOT NULL
                                )";
            $table_create_result = mysqli_query($connection, $table_create_query);
            if (!$table_create_result) {
                mysqli_close($connection);
                header("Location: reset_password.php?error=serverError");
                die();
            }
        }

        // Update the user password.
        $query = "UPDATE users SET password = '$password' WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            mysqli_close($connection);
            header("Location: reset_password.php?error=serverError");
            die();
        } else {
            // If the number of affected (changed) rows is not 1, the email does not exist.
            // If so, tell the user to reenter the correct information.
            if (mysqli_affected_rows($connection) != 1) {
                mysqli_close($connection);
                header("Location: reset_password.php?email=false");
                die();
            } else {
                unset($_SESSION["reset_password_email"]);
            }
        }
    }
    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Success - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="./styles/style-join.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header>
        <div id="navbar" class="obj-width">
            <a href="index.php"><img class="logo" src="images/logo.png" alt="Next_gen logo"></a>
            <!--responsive navbar-->
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <ul id="menu">
                <li><a class="navbar_button" href="jobs.php">Jobs</a></li>
                <li><a class="navbar_button" href="about.php">About</a></li>
                <li><a class="navbar_button" href="apply.php">Apply</a></li>
                <li><a class="navbar_button" href="contact.php">Contact</a></li>
                <li><a class="navbar_button" href="enhancements.php">Enhancements</a></li>
                <li><a id="w-btn" href ="join.php"> Join </a></li>
            </ul>
            <label for="nav-toggle" class="nav-toggle-label">
                <i class='bx bx-menu'></i>
            </label>
        </div>
    </header>
    <!--Body-->
    <main>
        <div class="container" style="width: 450px; padding: 20px;">
            <div class="form-container" style="transform: translateX(0); position: relative;">
                <h2>Success!</h2>
                <p style="color: #fff; margin-bottom: 20px;">Password reset successful. You can now <a href="./join.php" style="color: #4ecdc4; text-decoration: none;">login</a> with your new password.</p>
                <a href="join.php" class="form-button" style="text-decoration: none; display: inline-block; margin-top: 10px;">Return to Login</a>
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
                        <input type="email" placeholder="Enter your email" name="email">
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