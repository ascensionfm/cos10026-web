<?php
	// filename: user_logout.php
	// author: Nguyen Khanh Huyen
	// created: 13/3/2025
	// description: Script processing user logout. Does not generate any content.
?>

<?php
    session_start();
    // Unset the session variables associated with the user.
    unset($_SESSION["user_id"], 
          $_SESSION["username"], 
          $_SESSION["user_email"]);
    
    // Destroy the session completely
    session_destroy();
    
    // Redirect to the join page
    header("Location: index.php");
    exit();
?>