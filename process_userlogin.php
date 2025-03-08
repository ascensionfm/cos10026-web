<?php
	// filename: process_userlogin.php
	// author: Nguyen Khanh Huyen
	// created: 08/03/25
	// description: Script processing user login. Does not generate any content.
?>

<?php
    // Check if required inputs are available. The submit input is to prevent direct access.
    if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["submit"])) {
        header("Location: join.php");
        die();
    }

    // Sanitize the inputs.
    function sanitize($data) {
        return stripslashes(trim($data));
    }

    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    
    session_start();
    // Store the email into the session to reuse it when the user has to
    // resubmit the form.
    $_SESSION["login_email"] = $email;

    // Create the database connection.
    require_once("./settings.php");
    $connection = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$connection) {
        mysqli_close($connection);
        header("Location: join.php?error=serverError");
        die();
    } else {
        // Check if the users table exists. If not, create it.
        $table_check_query = "SHOW TABLES LIKE 'users'";
        $table_check_result = mysqli_query($connection, $table_check_query);
        if (mysqli_num_rows($table_check_result) != 1) {
            mysqli_free_result($table_check_result);
            $table_create_query = "CREATE TABLE users (
                                    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    username VARCHAR(25) NOT NULL,
                                    email TEXT NOT NULL,
                                    password TEXT NOT NULL
                                )";
            $table_create_result = mysqli_query($connection, $table_create_query);
            if (!$table_create_result) {
                mysqli_close($connection);
                header("Location: join.php?error=serverError");
                die();
            }
        }

        // Check if the entered email exists in the database.
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            // If the account does not exist, redirect to login.
            mysqli_free_result($result);
            mysqli_close($connection);
            header("Location: join.php?error=wrongInfo");
        } else {
            // If the account exists, verify the password
            $row = mysqli_fetch_assoc($result);
            
            // Verify the password using password_verify since we stored a hashed password
            if (password_verify($password, $row["password"])) {
                // Authentication successful, save user information in session
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["user_email"] = $row["email"];
                
                mysqli_free_result($result);
                
                // Remove unnecessary variables stored in session.
                unset($_SESSION["login_email"]);
                unset($_SESSION["signup_username"], $_SESSION["signup_email"]);
                
                mysqli_close($connection);
                
                // Redirect to after login page or homepage
                if (file_exists("after_login.php")) {
                    header("Location: after_login.php");
                } else {
                    header("Location: index.php");
                }
            } else {
                // Password doesn't match
                mysqli_free_result($result);
                mysqli_close($connection);
                header("Location: join.php?error=wrongInfo");
            }
        }
    }
?>