<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Header -->
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
    <div id="hero">
        <div id="glass">
            <h1>Innovation Meets Excellence</h1>
            <p>Next_Gen Corp is a dynamic IT company dedicated to pioneering the next wave of digital innovation. Our mission is to empower businesses and individuals with advanced technological solutions. With a focus on cutting-edge design and development, we are shaping the future of connectivity, efficiency, and success.</p>
            <p>Know more about us on<a href="https://youtu.be/AQpPQj62qUY" target="_blank">youtube</a>!</p>
        </div>
    </div>
    <div class="features">
        <div class="features-grid">
            <div class="feature-card">
                <h3>Innovation Hub</h3>
                <p>We're at the forefront of technological advancement, constantly pushing boundaries and creating solutions that define the future.</p>
            </div>
            <div class="feature-card">
                <h3>Global Reach</h3>
                <p>With offices across multiple continents, we offer opportunities to work on international projects and collaborate with diverse teams.</p>
            </div>
            <div class="feature-card">
                <h3>Career Growth</h3>
                <p>We invest in our people through continuous learning programs, mentorship, and clear career progression paths.</p>
            </div>
        </div>
    </div>
    <div class="feature1 sec-space obj-width">
        <h2>Need something done?</h2>
        <p id="service">Most viewed and all-time top-selling service</p>
        <div class="fe-box">
            <div>
                <img src="images/fe_1.png" alt="">
                <h3>Post a job</h3>
                <p>Simply post a job and receive competitive bids from freelancers within minutes.</p>
            </div>
            <div>
                <img src="images/fe_2.png" alt="">
                <h3>Choose freelancers</h3>
                <p>Find and select the best freelancer for your needs</p>
            </div>
            <div>
                <img src="images/fe_3.png" alt="">
                <h3>Pay safely</h3>
                <p>Make secure payments through a trusted system</p>
            </div>
            <div>
                <img src="images/fe_4.png" alt="">
                <h3>We're here to help</h3>
                <p>Get 24/7 support whenever you need assistance.</p>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-section">
                    <img class="footer-logo" src="images/logo.png" alt="Next_gen logo">
                    <p>Pioneering the next wave of digital innovation with cutting-edge solutions.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.twitter.com"><i class='bx bxl-twitter'></i></a>
                        <a href="https://www.linkedin.com"><i class='bx bxl-linkedin'></i></a>
                        <a href="https://www.instagram.com"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="jobs.php">Careers</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Projects</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Newsletter</h4>
                    <p>Subscribe to our newsletter for updates</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Enter your email" name="email">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Next_Gen Corporation. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
</body>
