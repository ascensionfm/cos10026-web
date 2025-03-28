<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhancements - Next_Gen Corporation</title>
  <link rel="icon" href="./images/logo1.ico">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/style-enhancements.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <?php require("header.inc"); ?>
  
  <main id="enhancements">
    <h1>Frontend Enhancements</h1>
    <p id="subtitle">This page presents two enhancements we have made as part of assignment 1.</p>
    <section>
        <h2>Responsive navigation bar</h2>
        <p>
            Our website features a responsive navigation bar that links all of our pages together. It features a
            logo, which takes the user to the home page when clicked on, as well as five navigation links to the
            different pages of our website. For large screens (more than 775px), the navigation links are
            laid out horizontally in a block. For smaller screen sizes, a button will appear in place of
            these links. Click on the menu button will make a panel containing the links to slide in from the right
            side of the screen. One more click in this button will automatically collapse it.
        </p>
        <figure>
            <a href="./images/enhance-navbar.png">
                <img src="./images/enhance-navbar.png" alt="Large screen navigation bar appearance">
            </a>
            <figcaption>The navigation bar appearance for large screens. Click on the image to see the full size.
            </figcaption>
        </figure>
        <figure>
            <a href="./images/enhance-navbar-after.png">
                <img src="./images/enhance-navbar-after.png" alt="Small screen navigation bar appearance">
            </a>
            <figcaption>The navigation bar appearance for small screens. Click on the image to see the full size.
            </figcaption>
        </figure>
        <p>
            The HTML markup for the responsive navigation bar.
        </p>
        <pre>
&lt;div id=&quot;navbar&quot; class=&quot;obj-width&quot;&gt;
  &lt;a href=&quot;index.php&quot;&gt;&lt;img class=&quot;logo&quot; src=&quot;images/logo.png&quot; alt=&quot;Next_gen logo&quot;&gt;&lt;/a&gt; &lt;input type=&quot;checkbox&quot; id=&quot;nav-toggle&quot; class=&quot;nav-toggle&quot;&gt;
    &lt;ul id=&quot;menu&quot;&gt;
        &lt;li&gt;&lt;a class=&quot;navbar_button&quot; href=&quot;jobs.php&quot;&gt;Jobs&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a class=&quot;navbar_button&quot; href=&quot;about.php&quot;&gt;About&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a class=&quot;navbar_button&quot; href=&quot;apply.php&quot;&gt;Apply&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a class=&quot;navbar_button&quot; href=&quot;contact.php&quot;&gt;Contact&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a id=&quot;w-btn&quot; href=&quot;join.php&quot;&gt;Join&lt;/a&gt;&lt;/li&gt;
    &lt;/ul&gt;
    &lt;label for=&quot;nav-toggle&quot; class=&quot;nav-toggle-label&quot;&gt;
        &lt;i class=&apos;bx bx-menu&apos;&gt;&lt;/i&gt;
    &lt;/label&gt;
&lt;/div&gt;
        </pre>
        <p>
            The CSS for the responsive navigation bar. Only key rulesets and
            properties needed for the responsivity of the navigation bar is
            included for the sake of brevity.
        </p>
        <pre>
        .navbar_button {
            color: #fff;
            text-decoration: none;
            margin-left: 40px;
            font-size: 1.3rem;
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }
        
        .navbar_button::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: white;
            transform: scaleX(0);
            transition: transform 0.3s;
        }
        
        #menu li a:hover::after {
            transform: scaleX(1);
        }
        
        #w-btn {
            margin-left: 40px;
            margin-right: 20px;
            font-size: 1.2rem;
            font-weight: 500;
            background: #fff;
            color: #1f3e5d;
            padding: 9px 30px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            opacity: 0;
            animation: fadeInUp 0.8s forwards 0.5s;
            text-decoration: none;
        }
        
        .apply-button button a {
            text-decoration: none;
            color: inherit;
        }
        
        #w-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        
        .nav-toggle {
            display: none;
        }
        
        .nav-toggle-label {
            display: none;
            color: #fff;
            font-size: 1.7rem;
            cursor: pointer;
            transition: transform 0.3s;
        }
        @media (max-width: 775px) {
          .nav-toggle-label {
              display: block;
          }
      
          #menu {
              background-color: #fff;
              display: block;
              width: 250px;
              height: auto;
              position: absolute;
              top: 80px;
              right: -300px;
              padding: 10px 0;
              box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
              border-radius: 13px;
              opacity: 0;
              transition: all 0.3s ease;
              z-index: 999; 
          }
      
      
          #menu li {
              padding: 1rem;
              animation: none;
              opacity: 1;
          }
      
          #menu li a {
              color: #1f3e5d;
              margin-left: 20px;
          }
      
          #menu li a::after {
              background-color: #1f3e5d;
          }
      
          .nav-toggle:checked ~ #menu {
              right: 10px;
              opacity: 1;
          }
      
      
          #w-btn { 
              margin-left: 20px;
              font-size: 1.4rem;
              font-weight: 500;
              background: #fff;
              color: #1f3e5d;
              padding: 12px 30px;
              border-radius: 20px;
              border: none;
              cursor: pointer;
              transition: all 0.3s;
              opacity: 1; 
              animation: none; 
          }
        }
        </pre>
        <p>
            This navigation bar is present at the top of all the pages of our website, including this page. Change
            the screen dimensions to see how it works!
        </p>
    </section>
    <section>
        <h2>
            Additional CSS to create mobile-specific layouts
        </h2>
        <p>
            For this website, in addition to the layouts specified by the assignment
            requirements, we have also added additional CSS to create layouts specific
            to mobile devices. This allows users to browse our site on smaller screens
            without compromising the user experience.
        </p>
        <p>
            To achieve this responsivity, we have included a viewport meta tag in each of our
            HTML pages and CSS media queries to apply additional rulesets at specific breakpoints.
        </p>
        <pre>
      &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;				
          </pre>
        <p>
            Example CSS on the <a href="./contact.php">contact.php</a> page to achieve responsivity.
        </p>
        <pre>
          @media (max-width: 650px) {
            .nav-toggle-label {
                display: block;
            } 
        
            .contact-info h1 {
                font-size: 3rem;
            }
        
            .contact-form h2 {
                font-size: 1.75rem;
                text-align: center;
            }
        
            .info-card {
                padding: 15px;
            }
        
            .contact-info, .contact-form {
                padding: 30px 20px;
            }
          }
          </pre>
        <p>
            Responsive design is done throughout our website but is most noticeable on our
            <a href="./jobs.php">jobs.php</a> and <a href="./contact.php">contact.php</a>
            pages. Change the dimensions of your browser window on these pages and pay attention
            to the layout changes.
        </p>
    </section>
</main>

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
