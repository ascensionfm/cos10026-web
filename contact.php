<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="styles/style-contact.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Header -->
    <header>
        <div id="navbar" class="obj-width">
            <a href="index.php"><img class="logo" src="images/logo.png" alt="Next_gen logo"></a>
            <!--responsive navbar-->
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
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
    <!--Body-->
    <main>
        <div class="contact-container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h1>Contact Us</h1>
                    <p>Whether you have inquiries, feedback, or simply wish to connect, our team is always ready to help. We're here to guide and support you every step of the way.</p>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <img src="images/add.png" alt="Location">
                        </div>
                        <div class="info-content">
                            <h4>Address</h4>
                            <p>No 80 Duy Tan, Dich Vong Hau, Cau Giay, Ha Noi</p>
                        </div>
                    </div>
    
                    <div class="info-card">
                        <div class="info-icon">
                            <img src="images/phone1.png" alt="Phone">
                        </div>
                        <div class="info-content">
                            <h4>Phone</h4>
                            <p>0859092236</p>
                        </div>
                    </div>
    
                    <div class="info-card">
                        <div class="info-icon">
                            <img src="images/mail1.png" alt="Email">
                        </div>
                        <div class="info-content">
                            <h4>Email</h4>
                            <p>dngminh7105@gmail.com</p>
                        </div>
                    </div>
                </div>
    
                <div class="contact-form">
                    <h2>Send Message</h2>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder=" ">
                            <label class="form-label">Full Name</label>
                        </div>
                        
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder=" ">
                            <label class="form-label">Email Address</label>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder=" ">
                            <label class="form-label">Title</label>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" rows="4" placeholder=" "></textarea>
                            <label class="form-label">Your Message</label>
                        </div>
    
                        <button type="submit" class="send-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--Footer-->
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