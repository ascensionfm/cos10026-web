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
    <?php require("header.inc"); ?>
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
    <?php require("footer.inc"); ?>
</body>