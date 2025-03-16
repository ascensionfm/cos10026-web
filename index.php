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
    <?php require("header.inc"); ?>
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
    <?php require("footer.inc"); ?>
</body>
