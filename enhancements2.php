<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Backend Enhancements - Next_Gen Corporation</title>
  <link rel="icon" href="./images/logo1.ico">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/style-enhancements.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <?php require("header.inc"); ?>
  
  <main id="enhancements">
    <h1>Backend Enhancements</h1>
    <p id="subtitle">This page presents the backend enhancements we have made as part of assignment 2.</p>
    <section>
        <h2>Enhancement 1: User Authentication System</h2>
        <p>
            We implemented a comprehensive user authentication system that allows users to register, login, and manage their profiles.
            The system includes secure password hashing, session management, and user-specific content display.
        </p>
        <figure>
            <a href="./images/enhancements-user-profile.png">
                <img src="./images/enhancements-user-profile.png" alt="User profile page screenshot">
            </a>
            <figcaption>The user profile page after successful authentication. Click on the image to see the full size.
            </figcaption>
        </figure>
        
        <h2>Enhancement 2: Form Data Validation and Processing</h2>
        <p>
            We implemented server-side validation for all form submissions to ensure data integrity and security.
            This includes input sanitization, data type checking, and appropriate error handling with user feedback.
        </p>
        <figure>
            <a href="./images/enhancements-autofill-fields.png">
                <img src="./images/enhancements-autofill-fields.png" alt="Form validation screenshot">
            </a>
            <figcaption>Form validation with error messages and field highlighting. Click on the image to see the full size.
            </figcaption>
        </figure>
        
        <h2>Enhancement 3: Admin Management Interface</h2>
        <p>
            We created a secure admin interface that allows authorized personnel to manage job listings, view applications,
            and perform administrative tasks. The interface includes role-based access control to ensure only authorized users
            can access sensitive information.
        </p>
        <figure>
            <a href="./images/enhancements-manage-auth.png">
                <img src="./images/enhancements-manage-auth.png" alt="Admin management interface screenshot">
            </a>
            <figcaption>The admin management interface for handling job applications. Click on the image to see the full size.
            </figcaption>
        </figure>
    </section>
  </main>
  
  <?php require("footer.inc"); ?>
</body>

</html>