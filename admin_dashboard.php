<?php
session_start();

$timeout_duration = 1800; // 30 minutes in seconds

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
    <link rel="stylesheet" href="styles/manage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 120px auto 50px;
            padding: 20px;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .dashboard-title {
            font-size: 28px;
            color: #333;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 15px;
        }
        
        .dashboard-actions a {
            padding: 8px 15px;
            background-color: #4ecdc4;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .dashboard-actions a:hover {
            background-color: #36b5ac;
        }
        
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            font-size: 24px;
            margin-bottom: 15px;
            color: #4ecdc4;
        }
        
        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        
        .card-value {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .card-description {
            color: #666;
            font-size: 14px;
        }
        
        .recent-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #4ecdc4;
            padding-bottom: 10px;
        }
        
        .recent-items {
            display: grid;
            gap: 15px;
        }
        
        .recent-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .recent-item:last-child {
            border-bottom: none;
        }
        
        .item-details {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .item-icon {
            font-size: 18px;
            color: #4ecdc4;
        }
        
        .item-name {
            font-weight: 500;
            color: #333;
        }
        
        .item-date {
            color: #888;
            font-size: 14px;
        }
        
        .item-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #ffe8cc;
            color: #ff9800;
        }
        
        .status-approved {
            background-color: #d4edda;
            color: #28a745;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #dc3545;
        }
        
        .logout-btn {
            background-color: #ff6b6b;
            color: white;
        }
        
        .logout-btn:hover {
            background-color: #e05555;
        }
    </style>
</head>
<body>
    <?php include 'header.inc'; ?>
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <div class="dashboard-actions">
                <a href="manage.php"><i class="fas fa-users"></i> Manage Applications</a>
                <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
                            if (isset($row['status'])) {
                                if ($row['status'] == 'Approved') {
                                    $statusClass = 'status-approved';
                                } else if ($row['status'] == 'Rejected') {
                                    $statusClass = 'status-rejected';
                                } else {
                                    $statusClass = 'status-pending';
                                }
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
                            echo "<div class='item-status {$statusClass}'>{$row['status']}</div>";
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