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
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/style-join.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <?php require("header.inc"); ?>
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
                <div class ="admin_login">
                    <a href="Mana_log.php" style="color: #fff; text-decoration: none;"><i class="fas fa-user-shield"></i> Admin Login</a>
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
    <?php require("footer.inc"); ?>
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