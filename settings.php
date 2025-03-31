<?php
$host = "localhost";
$username = "root";
$password = "ikon282006"; // Nếu có mật khẩu thì điền vào đây
$database = "test";

$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
