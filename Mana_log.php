<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Login</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style-join.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'header.inc'; ?>
    <main>
        <div class="container">
            <div class="form-container signin-container">
                <h2>Management Login</h2>
                <?php
                if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
                    echo '<p class="error-message" style="color: red;">Invalid username or password. Please try again.</p>';
                }
                ?>
                <form action="login_process.php" method="post">
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="bx bx-hide password-toggle"></i>
                    </div>
                    <button class="form-button" type="submit">Login</button>
                </form>
            </div>
        </div>
    </main>
    <?php include 'footer.inc'; ?>
</body>
</html>