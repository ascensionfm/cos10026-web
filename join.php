<?php
	// filename: signup.php
	// author: Nguyen Khanh Huyen
	// created: 08/03/25
	// description: Script processing user signup and login.
?>

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join - Next_Gen Corporation</title>
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
        <!-- Flying envelopes -->
        <i class="envelope fas fa-envelope" style="top: 20%; left: 10%"></i>
        <i class="envelope fas fa-envelope" style="top: 60%; left: 30%"></i>
        <i class="envelope fas fa-envelope" style="top: 40%; left: 70%"></i>
    
        <input type="checkbox" id="form-toggle">
        <div class="container">
            <!-- Envelope decoration -->
            <div class="envelope-border"></div>
            <div class="envelope-corner corner-tl"></div>
            <div class="envelope-corner corner-tr"></div>
            <div class="envelope-corner corner-bl"></div>
            <div class="envelope-corner corner-br"></div>
            
            <label class="toggle-label" for="form-toggle"></label>
            
            <div class="form-container signin-container">
                <h2>Login</h2>
                <?php
                    if (isset($_GET["error"])) {
                        $error = $_GET["error"];
                        if ($error == "serverError") {
                            echo '<p style="color: #ff6b6b; margin-bottom: 15px;">An error happened on the server.</p>';
                        } else if ($error == "wrongInfo") {
                            echo '<p style="color: #ff6b6b; margin-bottom: 15px;">Wrong login information.</p>';
                        } else if ($error == "emailUsed") {
                            echo '<p style="color: #ff6b6b; margin-bottom: 15px;">This email is already registered.</p>';
                        }
                    }

                    if (isset($_GET["message"])) {
                        $message = $_GET["message"];
                        if ($message == "registered") {
                            echo '<p style="color: #4ecdc4; margin-bottom: 15px;">You have created your account successfully.</p>';
                        }
                    }
                ?>
                <form action="./process_userlogin.php" method="post">
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
                <div class ="forgot_password">
                    <a href="reset_password.php" style="color: #fff; text-decoration: none;">Forgot password?</a>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="form-container signup-container">
                <h2>Sign up</h2>
                <?php
                    // Display validation errors for signup form
                    if (isset($_GET["username"]) && $_GET["username"] == "false") {
                        echo '<p style="color: #ff6b6b; margin-bottom: 15px;">Username must be between 3-25 characters.</p>';
                    }
                    if (isset($_GET["email"]) && $_GET["email"] == "false") {
                        echo '<p style="color: #ff6b6b; margin-bottom: 15px;">Please enter a valid email address.</p>';
                    }
                    if (isset($_GET["password"]) && $_GET["password"] == "false") {
                        echo '<p style="color: #ff6b6b; margin-bottom: 15px;">Password must be at least 8 characters.</p>';
                    }
                    if (isset($_GET["password_cf"]) && $_GET["password_cf"] == "false") {
                        echo '<p style="color: #ff6b6b; margin-bottom: 15px;">Passwords do not match.</p>';
                    }
                ?>
                <form action="./process_usersignup.php" method="post">
                    <div class="input-group">
                        <input type="text" name="user_name" placeholder="Username" required
                            <?php if (isset($_SESSION["signup_username"])) echo 'value="' . $_SESSION["signup_username"] . '"'; ?>
                        >
                    </div>
                    <div class="input-group">
                        <input type="email" name="signup_email" placeholder="Email" required
                            <?php if (isset($_SESSION["signup_email"])) echo 'value="' . $_SESSION["signup_email"] . '"'; ?>
                        >
                    </div>
                    <div class="input-group">
                        <input type="password" name="signup_password" placeholder="Password" required>
                        <i class="password-toggle fas fa-eye-slash" onclick="this.classList.toggle('fa-eye'); this.classList.toggle('fa-eye-slash'); const input = this.previousElementSibling; input.type = input.type === 'password' ? 'text' : 'password';"></i>
                    </div>
                    <div class="input-group">
                        <input type="password" name="signup_confirm_password" placeholder="Confirm password" required>
                        <i class="password-toggle fas fa-eye-slash" onclick="this.classList.toggle('fa-eye'); this.classList.toggle('fa-eye-slash'); const input = this.previousElementSibling; input.type = input.type === 'password' ? 'text' : 'password';"></i>
                    </div>
                    <button type="submit" name="signup" class="form-button">Sign up</button>
                </form>
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

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signup'])) {
        // Handle signup
        $email = $_POST['signup_email'];
        $password = $_POST['signup_password'];
        $confirm_password = $_POST['signup_confirm_password'];
        
        if ($password === $confirm_password) {
            // Include database credentials from settings.php
            include_once 'settings.php';
            $conn = new mysqli($host, $user, $pwd, $sql_db);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $stmt = $conn->prepare("INSERT INTO login (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $password);
            
            if ($stmt->execute()) {
                echo "Signup successful!";
            } else {
                echo "Signup failed: " . $stmt->error;
            }
            
            $stmt->close();
            $conn->close();
        } else {
            echo "Passwords do not match.";
        }
    }
}
?>