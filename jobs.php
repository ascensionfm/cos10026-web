<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs page - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="styles/style-jobs.css">
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
    <div class="container">
        <div class="search-container">
            <div class="search-box">
                <input type="text" placeholder="Search" name="search">
            </div>
            <select>
                <option value="">Location</option>
                <option>Ha Noi</option>
                <option>Đa Nang</option>
                <option>TP HCM</option>
                <option>Can Tho</option>
                <option>Hai Phong</option>
                <option>Ca Mau</option>
                <option>Quang Ninh</option>
                <option>International</option>
            </select>
            <select>
                <option value="">Salary</option>
                <option>Up to 10M</option>
                <option>10M - 30M</option>
                <option>30M - 50M</option>
                <option>Above 50M</option>
            </select>
            <button class="search-btn">Search</button>
        </div>

        <div class="jobs-grid">
            <div class="job-card" style="--order: 1">
                <div class="job-header">
                    <h3 class="job-title">Sales Executive (International Market)</h3>
                    <span class="hot-tag">Hot</span>
                </div>
                <div class="job-info">
                    <span>Up to 500M/year</span>
                    <span>Full Time</span>
                </div>
                <div class="job-info">
                    <span>Middle</span>
                    <span>Fukuoka, Japan</span>
                </div>
                <div class="tags">
                    <span class="tag">International Sales</span>
                    <span class="tag">Japanese</span>
                    <span class="tag">Korean</span>
                </div>
                <a href="job_detail/SE(IM).html" class="view-more">View more</a>
            </div>

            <div class="job-card" style="--order: 2">
                <div class="job-header">
                    <h3 class="job-title">Sales Manager – HCM</h3>
                    <span class="hot-tag">Hot</span>
                </div>
                <div class="job-info">
                    <span>Up to $2,500</span>
                    <span>Full Time</span>
                </div>
                <div class="job-info">
                    <span>Manager</span>
                    <span>HCM city</span>
                </div>
                <div class="tags">
                    <span class="tag">Sales</span>
                </div>
                <a href="job_detail/SM.html" class="view-more">View more</a>
            </div>

            <div class="job-card" style="--order: 3">
                <div class="job-header">
                    <h3 class="job-title">Senior AI Engineer</h3>
                    <span class="hot-tag">Hot</span>
                </div>
                <div class="job-info">
                    <span>Up to 50M</span>
                    <span>Full Time</span>
                </div>
                <div class="job-info">
                    <span>Senior</span>
                    <span>Ha Noi</span>
                </div>
                <a href="job_detail/SAE.html" class="view-more">View more</a>
            </div>

            <div class="job-card" style="--order: 4">
                <div class="job-header">
                    <h3 class="job-title">Technical Project Manager</h3>
                    <span class="hot-tag">Hot</span>
                </div>
                <div class="job-info">
                    <span>Up to 40M</span>
                    <span>Full Time</span>
                </div>
                <div class="job-info">
                    <span>Senior</span>
                    <span>Đa Nang</span>
                </div>
                <a href="job_detail/TPM.html" class="view-more">View more</a>
            </div>
            <div class="job-card" style="--order: 5">
                <div class="job-header">
                    <h3 class="job-title">Senior Solutions Architect / Consultant</h3>
                    <span class="hot-tag">New</span>
                </div>
                <div class="job-info">
                    <span>40M - 100M</span>
                    <span>Full Time</span>
                </div>
                <div class="job-info">
                    <span>Manager</span>
                    <span>Ho Chi Minh city</span>
                </div>
                <a href="job_detail/SSA.html" class="view-more">View more</a>
            </div>
            <div class="job-card" style="--order: 6">
                <div class="job-header">
                    <h3 class="job-title">Intern Project Coordinator</h3>
                    <span class="hot-tag">New</span>
                </div>
                <div class="job-info">
                    <span>4M</span>
                    <span>Part Time</span>
                </div>
                <div class="job-info">
                    <span>Intern</span>
                    <span>Ha Noi</span>
                </div>
                <div class="tags">
                    <span class="tag">English</span>
                    <span class="tag">Japanese</span>
                </div>
                <a href="job_detail/IPC.html" class="view-more">View more</a>
            </div>
            <div class="job-card" style="--order: 7">
                <div class="job-header">
                    <h3 class="job-title">Production Support</h3>
                    <span class="hot-tag">Hot</span>
                </div>
                <div class="job-info">
                    <span>Up to 45M</span>
                    <span>Full time</span>
                </div>
                <div class="job-info">
                    <span>Junior-Mid</span>
                    <span>Remote</span>
                </div>
                <a href="job_detail/PS.html" class="view-more">View more</a>
            </div>
            <div class="job-card" style="--order: 8">
                <div class="job-header">
                    <h3 class="job-title">Mid/Senior International Sales</h3>
                    <span class="hot-tag">Hot</span>
                </div>
                <div class="job-info">
                    <span>Negotiation</span>
                    <span>Full Time</span>
                </div>
                <div class="job-info">
                    <span>Mid-Senior</span>
                    <span>TP HCM</span>
                </div>
                <div class="tags">
                    <span class="tag">International</span>
                    <span class="tag">Chinese</span>
                </div>
                <a href="job_detail/MSIS.html" class="view-more">View more</a>
            </div>
            <div class="job-card" style="--order: 9">
                <div class="job-header">
                    <h3 class="job-title">Bridge System Engineer (BrSE) - Japan</h3>
                    <span class="hot-tag">New</span>
                </div>
                <div class="job-info">
                    <span>80M - 100M</span>
                    <span>Full Time</span>
                </div>
                <div class="job-info">
                    <span>Senior</span>
                    <span>Tokyo_Japan</span>
                </div>
                <a href="job_detail/BSE.html" class="view-more">View more</a>
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
