<?php
	// filename: reset_password.php
	// author: Nguyen Khanh Huyen
	// created: 08/03/25
	// description: Page for resetting users' password.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="./styles/style-join.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require("header.inc"); ?>
    <!--Body-->
    <main>
        <div class="container" style="width: 450px; padding: 20px;">
            <div class="form-container" style="transform: translateX(0); position: relative;">
                <h2>Reset Password</h2>
                <?php
                    if (isset($_GET["error"]) && $_GET["error"] == "serverError") {
                        echo '<p class="error" style="color: #ff6b6b; margin-bottom: 15px;">An error happened on the server.</p>';
                    }
                ?>
                <form action="./process_reset_password.php" method="post" style="width: 100%;">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required
                            <?php 
                                if (isset($_SESSION["reset_password_email"])) echo 'value="' . $_SESSION["reset_password_email"] . '"';
                                if (isset($_GET["email"]) && $_GET["email"] == "false") echo 'style="border-color: #ff6b6b;"';
                            ?>
                        >
                    </div>
                    <?php
                        if (isset($_GET["email"]) && $_GET["email"] == "false") {
                            echo '<p style="color: #ff6b6b; margin-top: -10px; margin-bottom: 15px; font-size: 0.8rem;">The email you entered does not exist.</p>';
                        }
                    ?>
                    
                    <div class="input-group">
                        <input type="password" name="password" placeholder="New Password" required
                            <?php 
                                if (isset($_GET["password"]) && $_GET["password"] == "false") echo 'style="border-color: #ff6b6b;"';
                            ?>
                        >
                        <i class="password-toggle fas fa-eye-slash" onclick="this.classList.toggle('fa-eye'); this.classList.toggle('fa-eye-slash'); const input = this.previousElementSibling; input.type = input.type === 'password' ? 'text' : 'password';"></i>
                    </div>
                    <?php
                        if (isset($_GET["password"]) && $_GET["password"] == "false") {
                            echo '<p style="color: #ff6b6b; margin-top: -10px; margin-bottom: 15px; font-size: 0.8rem;">Your password must be at least 10 characters long and comprise only letters, digits, and @ symbols.</p>';
                        }
                    ?>
                    
                    <div class="input-group">
                        <input type="password" name="password_cf" placeholder="Confirm Password" required
                            <?php 
                                if (isset($_GET["password_cf"]) && $_GET["password_cf"] == "false") echo 'style="border-color: #ff6b6b;"';
                            ?>
                        >
                        <i class="password-toggle fas fa-eye-slash" onclick="this.classList.toggle('fa-eye'); this.classList.toggle('fa-eye-slash'); const input = this.previousElementSibling; input.type = input.type === 'password' ? 'text' : 'password';"></i>
                    </div>
                    <?php
                        if (isset($_GET["password_cf"]) && $_GET["password_cf"] == "false") {
                            echo '<p style="color: #ff6b6b; margin-top: -10px; margin-bottom: 15px; font-size: 0.8rem;">Your passwords don\'t match.</p>';
                        }
                    ?>
                    
                    <button type="submit" name="submit" class="form-button">Reset Password</button>
                </form>
                <div style="margin-top: 20px;">
                    <a href="join.php" style="color: #fff; text-decoration: none;">Back to Login</a>
                </div>
            </div>
        </div>
    </main>

    <!--Footer-->
    <?php require("footer.inc"); ?>
</body>
</html>