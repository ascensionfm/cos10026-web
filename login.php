<?php
	// filename: login.php
	// author: Nguyen Khanh Huyen
	// created: 08/03/25
	// description: Page allowing users to log in.
?>

<?php
    session_start();

    // This page should not be accessed if the user is already logged in, as indicated
    // by the presence of the user_id session variable.
    if (isset($_SESSION["user_id"])) {
        header("Location: after_login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Next_Gen Corporation</title>
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
                <h2>Login</h2>
                <?php
                    if (isset($_GET["error"])) {
                        $error = $_GET["error"];
                        if ($error == "serverError") {
                            echo '<p style="color: #ff6b6b; margin-bottom: 15px;">An error happened on the server.</p>';
                        } else if ($error == "wrongInfo") {
                            echo '<p style="color: #ff6b6b; margin-bottom: 15px;">You entered the wrong login information.</p>';
                        }
                    }

                    if (isset($_GET["message"])) {
                        $message = $_GET["message"];
                        if ($message == "registered") {
                            echo '<p style="color: #4ecdc4; margin-bottom: 15px;">You have successfully created your account.</p>';
                        }
                    }
                ?>
                <form action="./process_userlogin.php" method="post" style="width: 100%;">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required
                            <?php if (isset($_SESSION["login_email"])) echo 'value="' . $_SESSION["login_email"] . '"'; ?>
                        >
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="password-toggle fas fa-eye-slash" onclick="this.classList.toggle('fa-eye'); this.classList.toggle('fa-eye-slash'); const input = this.previousElementSibling; input.type = input.type === 'password' ? 'text' : 'password';"></i>
                    </div>
                    <button type="submit" name="submit" class="form-button">Login</button>
                </form>
                <div style="margin-top: 20px;">
                    <p style="color: #fff;">Don't have an account? <a href="./signup.php" style="color: #4ecdc4; text-decoration: none;">Sign up</a></p>
                    <p style="color: #fff;"><a href="./reset_password.php" style="color: #4ecdc4; text-decoration: none;">Forgot password?</a></p>
                </div>
                <div class="social-icons" style="margin-top: 20px;">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
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