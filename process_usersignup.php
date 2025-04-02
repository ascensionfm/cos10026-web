<?php
	// filename: process_usersignup.php
	// author: Nguyen Khanh Huyen
	// created: 09/03/25
	// description: Script processing user signup
?>

<?php
    require 'password.php';
    // Check if required inputs are available. The submit input is to prevent direct access.
    if (!isset($_POST["user_name"]) || 
        !isset($_POST["signup_email"]) || 
        !isset($_POST["signup_password"]) || 
        !isset($_POST["signup_confirm_password"]) || 
        !isset($_POST["signup"])) {
        header("Location: join.php");
        die();
    }

    // Sanitize the inputs.
    function sanitize($data) {
        return stripslashes(trim($data));
    }

    $username = sanitize($_POST["user_name"]);
    $email = sanitize($_POST["signup_email"]);
    $password = sanitize($_POST["signup_password"]);
    $confirm_password = sanitize($_POST["signup_confirm_password"]);

    session_start();
    // Store the entered information into the session to reuse it when the user has to
    // resubmit the form.
    $_SESSION["signup_username"] = $username;
    $_SESSION["signup_email"] = $email;

    // Create an array for errors.
    $errors = array();

    if (strlen($username) < 3 || strlen($username) > 25) {
        array_push($errors, "username=false");
    }
    if (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9_.+-]+\.[a-zA-Z]{2,4}$/i", $email)) {
        array_push($errors, "email=false");
    }
    if (!preg_match("/^[a-zA-Z0-9@]{8,}$/i", $password)) {
        array_push($errors, "password=false");
    }
    if ($password != $confirm_password) {
        array_push($errors, "password_cf=false");
    }

    // If there is an error, redirect to join page.
    if (count($errors) != 0) {
        header("Location: join.php?" . implode("&", $errors));
        die();
    }

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

        // Check if the entered email already exists in the database.
        $email_check_query = "SELECT * FROM users WHERE email = '$email'";
        $email_check_result = mysqli_query($connection, $email_check_query);
        
        if (mysqli_num_rows($email_check_result) == 0) {
            // If the account does not exist, create it.
            mysqli_free_result($email_check_result);
            
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $account_create_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            $account_create_result = mysqli_query($connection, $account_create_query);
            
            mysqli_close($connection);
            if (!$account_create_result) {
                header("Location: join.php?error=serverError");
            } else {
                // Remove unnecessary variables stored in session.
                unset($_SESSION["signup_username"], $_SESSION["signup_email"]);
                header("Location: join.php?message=registered");
            }
        } else {
            // If the account already exists, redirect to join page.
            mysqli_free_result($email_check_result);
            mysqli_close($connection);
            header("Location: join.php?error=emailUsed&email=false");
        }
    }
?>