<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/style-apply-confirmation.css">
</head>
<body>
    <?php
    session_start();
        if (!isset($_SESSION['management_loggedin']) || $_SESSION['management_loggedin'] !== true) {
            header('Location: Mana_log.php');
            exit;
        }
    ?>    
    <?php require("header.inc"); ?>
                <div class="confirmation-message">
                    <p>Resume</p>
                </div>
                <?php
                require_once("settings.php");

                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                if (!$conn) {
                    echo "<p>Database connection failed: " . mysqli_connect_error() . "</p>";
                    exit();
                }
                ?>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
                    $id = intval($_POST["id"]);
                    $query = "SELECT * FROM applications WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id);

                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $jobReference = $row["job_reference"];
                            $firstName = $row["first_name"];
                            $lastName = $row["last_name"];
                            $dateOfBirth = $row["date_of_birth"];
                            $gender = $row["gender"];
                            $streetAddress = $row["street_address"];
                            $suburb = $row["suburb"];
                            $state = $row["state"];
                            $postcode = $row["postcode"];
                            $email = $row["email"];
                            $phone = $row["phone"];
                            $skills = $row["skills"];
                            $otherSkills = $row["other_skills"];
                            $photoPath = $row["photo_path"];
                        } else {
                            echo "<p>No application found with the provided ID.</p>";
                            exit();
                        }
                    } else {
                        echo "<p>Error executing query: " . $stmt->error . "</p>";
                        exit();
                    }

                    $stmt->close();
                } else {
                    echo "<p>Invalid request. No ID provided.</p>";
                    exit();
                }
                ?>
                <div class="cv-container">
                    <div class="cv-header">
                        <div class="cv-photo">
                            <img src="<?php echo $photoPath; ?>" alt="Applicant Photo">
                        </div>
                        <div class="cv-name">
                            <h1><?php echo $firstName . " " . $lastName; ?></h1>
                            <p class="job-reference">Job Reference: <?php echo $jobReference; ?></p>
                        </div>
                    </div>

                    <div class="cv-contact">
                        <div class="contact-item">
                            <i class='bx bx-envelope'></i>
                            <span><?php echo $email; ?></span>
                        </div>
                        <div class="contact-item">
                            <i class='bx bx-phone'></i>
                            <span><?php echo $phone; ?></span>
                        </div>
                        <div class="contact-item">
                            <i class='bx bx-map'></i>
                            <span><?php echo $streetAddress . ", " . $suburb . ", " . $state . " " . $postcode; ?></span>
                        </div>
                    </div>

                    <div class="cv-section">
                        <h2>Personal Information</h2>
                        <div class="cv-info">
                            <div class="info-item">
                                <h3>Date of Birth</h3>
                                <p><?php echo $dateOfBirth; ?></p>
                            </div>
                            <div class="info-item">
                                <h3>Gender</h3>
                                <p><?php echo ucfirst($gender); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="cv-section">
                        <h2>Skills</h2>
                        <div class="skills-container">
                            <?php if (!empty($skills)): ?>
                                <div class="skill-tags">
                                    <?php 
                                    $skillsArr = explode(", ", $skills);
                                    foreach ($skillsArr as $skill): 
                                    ?>
                                        <span class="skill-tag"><?php echo ucfirst($skill); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($otherSkills)): ?>
                                <div class="other-skills">
                                    <h3>Additional Skills</h3>
                                    <p><?php echo $otherSkills; ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="manage.php" class="btn">Back to Management Interface</a>
                </div>
        </div>
    </main>
    <?php require("footer.inc"); ?>
</body>
</html>
