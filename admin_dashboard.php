<?php
session_start();

$timeout_duration = 500; // 30 minutes in seconds

if (!isset($_SESSION['management_loggedin']) || $_SESSION['management_loggedin'] !== true) {
    header('Location: Mana_log.php');
    exit;
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header('Location: Mana_log.php');
    exit;
}

$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style-admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
</head>
<body>
    <?php include 'header.inc'; ?>
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <div class="dashboard-actions">
                <a href="manage.php"><i class="fas fa-users"></i> Manage Applications</a>
                <a href="admin_logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <h3 class="card-title">Total Applications</h3>
                <div class="card-value">
                    <?php
                    require_once 'settings.php';
                    $conn = new mysqli($host, $user, $pwd, $sql_db);
                    if ($conn->connect_error) {
                        echo "Error";
                    } else {
                        $result = $conn->query("SELECT COUNT(*) as total FROM applications");
                        if ($result && $row = $result->fetch_assoc()) {
                            echo $row['total'];
                        } else {
                            echo "0";
                        }
                    }
                    ?>
                </div>
                <p class="card-description">Total number of job applications received</p>
            </div>
            
            <div class="card">
                <div class="card-icon"><i class="fas fa-check-circle"></i></div>
                <h3 class="card-title">Approved</h3>
                <div class="card-value">
                    <?php
                    if ($conn->connect_error) {
                        echo "Error";
                    } else {
                        $result = $conn->query("SELECT COUNT(*) as total FROM applications WHERE status = 'Approved'");
                        if ($result && $row = $result->fetch_assoc()) {
                            echo $row['total'];
                        } else {
                            echo "0";
                        }
                    }
                    ?>
                </div>
                <p class="card-description">Applications that have been approved</p>
            </div>
            
            <div class="card">
                <div class="card-icon"><i class="fas fa-clock"></i></div>
                <h3 class="card-title">Pending</h3>
                <div class="card-value">
                    <?php
                    if ($conn->connect_error) {
                        echo "Error";
                    } else {
                        $result = $conn->query("SELECT COUNT(*) as total FROM applications WHERE status = 'Pending'");
                        if ($result && $row = $result->fetch_assoc()) {
                            echo $row['total'];
                        } else {
                            echo "0";
                        }
                    }
                    ?>
                </div>
                <p class="card-description">Applications awaiting review</p>
            </div>
            
            <div class="card">
                <div class="card-icon"><i class="fas fa-times-circle"></i></div>
                <h3 class="card-title">Rejected</h3>
                <div class="card-value">
                    <?php
                    if ($conn->connect_error) {
                        echo "Error";
                    } else {
                        $result = $conn->query("SELECT COUNT(*) as total FROM applications WHERE status = 'Rejected'");
                        if ($result && $row = $result->fetch_assoc()) {
                            echo $row['total'];
                        } else {
                            echo "0";
                        }
                    }
                    ?>
                </div>
                <p class="card-description">Applications that have been rejected</p>
            </div>
        </div>
        
        <div class="recent-section">
            <h2 class="section-title">Recent Applications</h2>
            <div class="recent-items">
                <?php
                if ($conn->connect_error) {
                    echo "<p>Could not connect to database</p>";
                } else {
                    $result = $conn->query("SELECT * FROM applications ORDER BY id DESC LIMIT 5");
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $statusClass = '';
                            $status = isset($row['status']) ? $row['status'] : 'Pending';
                            
                            if ($status == 'Approved') {
                                $statusClass = 'status-approved';
                            } else if ($status == 'Rejected') {
                                $statusClass = 'status-rejected';
                            } else {
                                $statusClass = 'status-pending';
                            }
                            
                            echo "<div class='recent-item'>";
                            echo "<div class='item-details'>";
                            echo "<div class='item-icon'><i class='fas fa-file-alt'></i></div>";
                            echo "<div>";
                            echo "<div class='item-name'>{$row['first_name']} {$row['last_name']}</div>";
                            echo "<div class='item-date'>Job Reference: {$row['job_reference']}</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='item-status {$statusClass}'>{$status}</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No applications found</p>";
                    }
                    
                    $conn->close();
                }
                ?>
            </div>
        </div>
    </div>
    
    <?php include 'footer.inc'; ?>
</body>
</html>