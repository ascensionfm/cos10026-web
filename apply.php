<?php
	// filename: apply.php
  // author: Nguyen Khanh Huyen
  // created: 13/3/2025
	// description: This page display a formform for applying job
?>

<?php
  session_start();
  
  // Check if user is logged in
  if (!isset($_SESSION["user_id"])) {
    // User is not logged in, display message and redirect
    echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Required - Next_Gen Corporation</title>
  <link rel="icon" href="./images/logo1.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/style-apply.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
        <i class="bx bx-menu"></i>
      </label>
    </div>
  </header>
  
  <main>
    <div class="login-required">
      <i class="fas fa-user-lock login-icon"></i>
      <h2>Login Required</h2>
      <p>You need to login first to access the application form. </p>
      <div>
        <a href="join.php">Login</a>
        
      </div>
    </div>
  </main>
  
  <footer>
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-section">
                <img class="footer-logo" src="images/logo.png" alt="Next_gen logo">
                <p>Pioneering the next wave of digital innovation with cutting-edge solutions.</p>
                <div class="social-links">
                  <a href="https://www.facebook.com"><i class="bx bxl-facebook"></i></a>
                  <a href="https://www.twitter.com"><i class="bx bxl-twitter"></i></a>
                  <a href="https://www.linkedin.com"><i class="bx bxl-linkedin"></i></a>
                  <a href="https://www.instagram.com"><i class="bx bxl-instagram"></i></a>
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
</html>';
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apply - Next_Gen Corporation</title>
  <link rel="icon" href="./images/logo1.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/style-apply.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .error-message {
      color: red;
      font-size: 0.9em;
      margin-top: 5px;
      display: none;
    }

    input:invalid + .error-message,
    select:invalid + .error-message,
    textarea:invalid + .error-message {
      display: block;
    }
  </style>
</head>
<body>
<?php require("header.inc"); ?>
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
          <div class="upload-btn">Choose Photo</div>
          <input type="file" id="photoInput" accept="image/*" onchange="previewPhoto(event)" name="image">
        </div>
        <div class="file-name" id="photoName"></div>
      </div>
      <form id="applicationForm" action="apply_confirmation.php" method="post" enctype="multipart/form-data" name="applicationForm" novalidate="novalidate">
        <div class="form-group">
          <label for="job-reference">Job Reference Number</label>
          <input id="job-reference" name="job-reference" type="text" pattern="^[a-zA-Z0-9]{5}$" required="" placeholder="Enter 5 alphanumeric characters" value="<?php echo isset($_SESSION['form_data']['job-reference']) ? htmlspecialchars($_SESSION['form_data']['job-reference']) : ''; ?>">
          <div class="error-message">
            Must be exactly 5 alphanumeric characters
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <label for="first-name">First Name</label>
            <input id="first-name" name="first-name" type="text" maxlength="20" pattern="[A-Za-z]{1,20}" required="" placeholder="Max 20 alpha characters" value="<?php echo isset($_SESSION['form_data']['first-name']) ? htmlspecialchars($_SESSION['form_data']['first-name']) : ''; ?>">
          </div>
          <div class="col">
            <label for="last-name">Last Name</label>
            <input id="last-name" name="last-name" type="text" maxlength="20" pattern="[A-Za-z]{1,20}" required="" placeholder="Max 20 alpha characters" value="<?php echo isset($_SESSION['form_data']['last-name']) ? htmlspecialchars($_SESSION['form_data']['last-name']) : ''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="date-of-birth">Date of Birth</label>
          <input id="date-of-birth" name="date-of-birth" type="date" required="" value="<?php echo isset($_SESSION['form_data']['date-of-birth']) ? htmlspecialchars($_SESSION['form_data']['date-of-birth']) : ''; ?>">
        </div>
        <div class="form-group">
          <fieldset class="fieldset-container">
            <legend>Gender</legend>
            <div class="radio-group">
              <label><input type="radio" name="gender" value="male" required="" <?php echo (isset($_SESSION['form_data']['gender']) && $_SESSION['form_data']['gender'] === 'male') ? 'checked' : ''; ?>> Male</label>
              <label><input type="radio" name="gender" value="female" <?php echo (isset($_SESSION['form_data']['gender']) && $_SESSION['form_data']['gender'] === 'female') ? 'checked' : ''; ?>> Female</label>
              <label><input type="radio" name="gender" value="other" <?php echo (isset($_SESSION['form_data']['gender']) && $_SESSION['form_data']['gender'] === 'other') ? 'checked' : ''; ?>> Other</label>
            </div>
          </fieldset>
        </div>
        <div class="form-group">
          <label for="street-address">Street Address</label>
          <input id="street-address" name="street-address" type="text" maxlength="40" required="" placeholder="Max 40 characters" value="<?php echo isset($_SESSION['form_data']['street-address']) ? htmlspecialchars($_SESSION['form_data']['street-address']) : ''; ?>">
        </div>
        <div class="form-group">
          <label for="suburb">Suburb/Town</label>
          <input id="suburb" name="suburb" type="text" maxlength="40" required="" placeholder="Max 40 characters" value="<?php echo isset($_SESSION['form_data']['suburb']) ? htmlspecialchars($_SESSION['form_data']['suburb']) : ''; ?>">
        </div>
        <div class="form-group row">
          <div class="col">
            <label for="state">State</label>
            <select id="state" name="state" required>
              <option value="" disabled <?php echo !isset($_SESSION['form_data']['state']) ? 'selected' : ''; ?>>Select your state</option>
              <?php
              $states = ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"];
              foreach ($states as $state) {
                echo "<option value=\"$state\" " . (isset($_SESSION['form_data']['state']) && $_SESSION['form_data']['state'] === $state ? 'selected' : '') . ">$state</option>";
              }
              ?>
            </select>
          </div>
          <div class="col">
            <label for="postcode">Postcode</label>
            <input id="postcode" name="postcode" type="text" pattern="[0-9]{4}" required="" placeholder="4 digits" value="<?php echo isset($_SESSION['form_data']['postcode']) ? htmlspecialchars($_SESSION['form_data']['postcode']) : ''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input id="email" name="email" type="email" required="" placeholder="Enter valid email address" value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input id="phone" name="phone" type="tel" pattern="[0-9 ]{8,12}" required="" placeholder="8 to 12 digits, spaces allowed" value="<?php echo isset($_SESSION['form_data']['phone']) ? htmlspecialchars($_SESSION['form_data']['phone']) : ''; ?>">
        </div>
        <div class="form-group">
          <fieldset class="fieldset-container">
            <legend>Skills</legend>
            <div class="checkbox-group">
              <?php
              $skills = ["Programming", "Design", "Marketing", "Sales", "Management", "English", "Japanese", "Chinese", "Other"];
              $selectedSkills = isset($_SESSION['form_data']['skills']) ? $_SESSION['form_data']['skills'] : [];
              foreach ($skills as $skill) {
                echo "<label><input type=\"checkbox\" name=\"skills[]\" value=\"$skill\" " . (in_array($skill, $selectedSkills) ? 'checked' : '') . "> $skill</label>";
              }
              ?>
            </div>
          </fieldset>
        </div>
        <div class="form-group">
          <label for="other-skills">Other Skills</label>
          <textarea id="other-skills" name="other-skills" rows="4" placeholder="Describe your other skills..."><?php echo isset($_SESSION['form_data']['other-skills']) ? htmlspecialchars($_SESSION['form_data']['other-skills']) : ''; ?></textarea>
        </div>
        <div class="btn-container">
          <?php
          if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            echo '<div class="error-messages"><ul>';
            foreach ($_SESSION['errors'] as $error) {
              echo "<li>$error</li>";
            }
            echo '</ul></div>';
            unset($_SESSION['errors']); // Clear errors after displaying
          }
          ?>
          <button type="submit" class="btn btn-submit">Submit Application</button>
          <button type="reset" class="btn btn-reset">Reset</button>
        </div>
      </form>
    </div>
  </main>
  <?php require("footer.inc"); ?>
</body>
<script>
function previewPhoto(event) {
    const fileInput = event.target;
    const photoPreview = document.getElementById('photoPreview');
    const photoName = document.getElementById('photoName');
    
    if (fileInput.files && fileInput.files[0]) {
        const file = fileInput.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // remove placeholder text
            const placeholder = photoPreview.querySelector('.placeholder-text');
            if (placeholder) {
                placeholder.remove();
            }
            
            // remove current image if exists
            const existingImg = photoPreview.querySelector('img');
            if (existingImg) {
                existingImg.remove();
            }
            
            // create and add new image
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = "Uploaded Photo";
            photoPreview.appendChild(img);
            
            // file's name
            photoName.textContent = file.name;
        };
        
        reader.readAsDataURL(file);
    }
}
// Ensure the photo input is included in the form submission
document.getElementById('applicationForm').addEventListener('submit', function(e) {
    const photoInput = document.getElementById('photoInput');
    if (photoInput.files.length > 0) {
        // Copy the photo input to the form
        this.appendChild(photoInput.cloneNode(true));
    }
});
</script>
</html>