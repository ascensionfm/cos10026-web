<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apply - Next_Gen Corporation</title>
  <link rel="icon" href="./images/logo1.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="styles/style-apply.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <header>
    <div id="navbar" class="obj-width">
      <a href="index.php"><img class="logo" src="images/logo.png" alt="Next_gen logo"></a> <input type="checkbox" id="nav-toggle" class="nav-toggle">
      <ul id="menu">
        <li><a class="navbar_button" href="jobs.php">Jobs</a></li>       
        <li><a class="navbar_button" href="about.php">About</a></li> 
        <li><a class="navbar_button" href="apply.php">Apply</a></li> 
        <li><a class="navbar_button" href="contact.php">Contact</a></li>  
        <li><a class="navbar_button" href="enhancements.php">Enhancements</a></li>       
        <li><a id="w-btn" href="join.php">Join</a></li>   
      </ul>
      <label for="nav-toggle" class="nav-toggle-label">
        <i class='bx bx-menu'></i>
      </label>
    </div>
  </header>
  <main class="main-content">
    <div class="container">
      <div class="upload-container">
        <h3>Upload Photo</h3>
        <div class="photo-preview" id="photoPreview">
          <div class="placeholder-text">
            <p>Upload a passport-sized photo</p>
          </div>
        </div>
        <div class="file-upload">
          <div class="upload-btn">
            Choose Photo
          </div><input type="file" id="photoInput" accept="image/*" onchange="previewPhoto(event)" name="image">
        </div>
        <div class="file-name" id="photoName"></div>
      </div>
      <form id="applicationForm" action="apply_confirmation.php" method="post" enctype="multipart/form-data" name="applicationForm"> 
        <div class="form-group">
          <label for="job-reference">Job Reference Number</label> <input id="job-reference" name="job-reference" type="text" pattern="^[a-zA-Z0-9]{5}$" required="" placeholder="Enter 5 alphanumeric characters">
          <div class="error-message">
            Must be exactly 5 alphanumeric characters
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <label for="first-name">First Name</label> <input id="first-name" name="first-name" type="text" maxlength="20" pattern="[A-Za-z]{1,20}" required="" placeholder="Max 20 alpha characters">
          </div>
          <div class="col">
            <label for="last-name">Last Name</label> <input id="last-name" name="last-name" type="text" maxlength="20" pattern="[A-Za-z]{1,20}" required="" placeholder="Max 20 alpha characters">
          </div>
        </div>
        <div class="form-group">
          <label for="date-of-birth">Date of Birth</label> <input id="date-of-birth" name="date-of-birth" type="date" required="">
        </div>
        <div class="form-group">
          <fieldset class="fieldset-container">
            <legend>Gender</legend>
            <div class="radio-group">
              <label><input type="radio" name="gender" value="male" required=""> Male</label> <label><input type="radio" name="gender" value="female"> Female</label> <label><input type="radio" name="gender" value="other"> Other</label>
            </div>
          </fieldset>
        </div>
        <div class="form-group">
          <label for="street-address">Street Address</label> <input id="street-address" name="street-address" type="text" maxlength="40" required="" placeholder="Max 40 characters">
        </div>
        <div class="form-group">
          <label for="suburb">Suburb/Town</label> <input id="suburb" name="suburb" type="text" maxlength="40" required="" placeholder="Max 40 characters">
        </div>
        <div class="form-group row">
          <div class="col">
            <label for="state">State</label> <input id="state" name="state" type="text" maxlength="40" required="" placeholder="Max 40 characters">
          </div>
          <div class="col">
            <label for="postcode">Postcode</label> <input id="postcode" name="postcode" type="text" pattern="[0-9]{4}" required="" placeholder="4 digits">
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label> <input id="email" name="email" type="email" required="" placeholder="Enter valid email address">
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label> <input id="phone" name="phone" type="tel" pattern="[0-9 ]{8,12}" required="" placeholder="8 to 12 digits, spaces allowed">
        </div>
        <div class="form-group">
          <fieldset class="fieldset-container">
            <legend>Skills</legend>
            <div class="checkbox-group">
              <label><input type="checkbox" name="skills[]" value="programming"> Programming</label> <label><input type="checkbox" name="skills[]" value="design"> Design</label> <label><input type="checkbox" name="skills[]" value="marketing"> Marketing</label> <label><input type="checkbox" name="skills[]" value="sales"> Sales</label> <label><input type="checkbox" name="skills[]" value="management"> Management</label> <label><input type="checkbox" name="skills[]" value="english"> English</label> <label><input type="checkbox" name="skills[]" value="japanese"> Japanese</label> <label><input type="checkbox" name="skills[]" value="chinese"> Chinese</label> <label><input type="checkbox" name="skills[]" value="other"> Other skills...</label>
            </div>
          </fieldset>
        </div>
        <div class="form-group">
          <label for="other-skills">Other Skills</label> 
          <textarea id="other-skills" name="other-skills" rows="4" placeholder="Describe your other skills..."></textarea>
        </div>
        <div class="btn-container">
          <button type="submit" class="btn btn-submit">Submit Application</button> <button type="reset" class="btn btn-reset">Reset</button>
        </div>
      </form>
    </div>
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
                    <input type="email" placeholder="Enter your email">
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
</html>