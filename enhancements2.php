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
        <h2>User Authentication System</h2>
        <p>
            A comprehensive user authentication system has been used that allows users to register, login, and manage their profiles.
            The system includes secure password hashing, session management, and user-specific content display. Note that users can't access the apply form if they don't log in first.
            This is to ensure that only registered users can apply for jobs, enhancing security and user experience.
        </p>
        <figure>
            <a href="./images/user-profile.png">
                <img src="./images/user-profile.png" alt="User profile page">
            </a>
            <figcaption>The user profile page after successful authentication. Click on the image to see the full size.
            </figcaption>
        </figure>
        
        <h2>Form Data Validation and Processing</h2>
        <p>
            We implemented server-side validation for all form submissions to ensure data integrity and security.
            This includes input sanitization, data type checking, and appropriate error handling with feedbacks that help user to know what should be modified.
        </p>
        <figure>
            <a href="./images/form-validation.png">
                <img src="./images/form-validation.png" alt="Form validation">
            </a>
            <figcaption>Form validation with error messages and field highlighting. Click on the image to see the full size.
            </figcaption>
        </figure>
        
        <h2>Admin Management Interface</h2>
        <p>
            We created a secure admin interface that allows authorized personnel to manage job listings, view applications,
            and perform administrative tasks. The interface includes role-based access control to ensure only authorized users
            can access sensitive information.
        </p>
        <figure>
            <a href="./images/manage-dashboard.png">
                <img src="./images/manage-dashboard.png" alt="Admin management interface">
            </a>
            <figcaption>The admin management interface for the overview information of applicants (total, status, recent). Click on the image to see the full size.
            </figcaption>
        </figure>
        <figure>
            <a href="./images/manage-detail.png">
                <img src="./images/manage-detail.png" alt="Admin detail interface">
            </a>
            <figcaption>Where admin can review applicants, delete or filter by name, dob,... Click on the image to see the full size.
            </figcaption>
        </figure>
    </section>
  </main>
  
  <?php require("footer.inc"); ?>
</body>

</html>