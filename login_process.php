<?php
	// filename: login_process.php
	// author: Nguyen Quy Vuong (modified from process_userlogin.php)
	// created: 13/3/2025
	// description: Login process for management users
?>
<?php
require_once 'settings.php';
require 'password.php';
// Create connection
$conn = new mysqli($host, $user, $pwd, $sql_db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Verify credentials
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM management_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        $stmt->close();
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['management_loggedin'] = TRUE;
            session_write_close() ;
            if ($username === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: manage.php");
            }
            exit();
        } else {
            header("Location: Mana_log.php?error=invalid_credentials");
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
}

$conn->close();
?>
