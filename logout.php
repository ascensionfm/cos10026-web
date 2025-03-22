<?php
// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the homepage
header("Location: /index.php");
exit();
?>