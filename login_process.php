<?php
require_once 'settings.php';

// Create connection
$conn = new mysqli($host, $user, $pwd, $sql_db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS management_users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    // Check if admin user exists
    $check_admin = "SELECT * FROM management_users WHERE username = 'admin'";
    $result = $conn->query($check_admin);
    
    // If admin doesn't exist, create it
    if ($result->num_rows == 0) {
        $admin_username = 'admin';
        $admin_password = password_hash('admin123', PASSWORD_DEFAULT);
        
        $insert_admin = "INSERT INTO management_users (username, password) VALUES ('$admin_username', '$admin_password')";
        $conn->query($insert_admin);
    }
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
