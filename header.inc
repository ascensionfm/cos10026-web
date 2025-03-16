<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!-- Header -->
<!-- This file should be included after the following in the head section:
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
-->
<header>
        <div id="navbar" class="obj-width">
            <a href="index.php"><img class="logo" src="images/logo.png" alt="Next_gen logo"></a>
            <!--responsive navbar-->
            <input type="checkbox" id="nav-toggle" class="nav-toggle" name="checkbox">
            <ul id="menu">
                <li><a class="navbar_button" href="jobs.php">Jobs</a></li>
                <li><a class="navbar_button" href="about.php">About</a></li>
                <li><a class="navbar_button" href="apply.php">Apply</a></li>
                <li><a class="navbar_button" href="contact.php">Contact</a></li>
                <li><a class="navbar_button" href="enhancements.php">Enhancements</a></li>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <li><a id="w-btn" href="after_login.php"><i class='bx bx-user'></i></a></li>
                <?php else: ?>
                    <li><a id="w-btn" href="join.php">Join</a></li>
                <?php endif; ?>
            </ul>
            <label for="nav-toggle" class="nav-toggle-label">
                <i class='bx bx-menu'></i>
            </label>
        </div>
    </header>