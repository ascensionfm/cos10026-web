<?php
// filename: admin_logout.php
// description: Script processing admin logout. Does not generate any content.

// Start the session
session_start();

// Unset the session variables associated with the admin
unset($_SESSION["username"], 
      $_SESSION["management_loggedin"],
      $_SESSION["last_activity"]);

// Destroy the session completely
session_destroy();

// Redirect to the homepage
header("Location: index.php");
exit();
?>