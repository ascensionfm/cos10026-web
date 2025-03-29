<?php
session_start();
require("settings.php");
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("No job specified.");
}
$job_id = intval($_GET['id']);
$sql = "SELECT * FROM jobs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();
$job = $result->fetch_assoc();

if (!$job) {
    die("Job not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['title']); ?> - Job Details</title>
    <link rel="stylesheet" href="./styles/style-job-detail.css">
</head>
<body>
    <?php require("header.inc"); ?>
    <div class="container">
        <h1 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h1>
        <div class="job-details">
            <div class="detail-card">
                <i class="fas fa-money-bill-wave"></i>
                <div class="label">Salary</div>
                <div class="value"><?php echo htmlspecialchars($job['salary']); ?></div>
            </div>
            <div class="detail-card">
                <i class="fas fa-level-up-alt"></i>
                <div class="label">Level</div>
                <div class="value"><?php echo htmlspecialchars($job['level']); ?></div>
            </div>
            <div class="detail-card">
                <i class="fas fa-clock"></i>
                <div class="label">Type</div>
                <div class="value"><?php echo htmlspecialchars($job['job_type']); ?></div>
            </div>
            <div class="detail-card">
                <i class="fas fa-map-marker-alt"></i>
                <div class="label">Location</div>
                <div class="value"><?php echo htmlspecialchars($job['location']); ?></div>
            </div>
        </div>
        <div class="section-title">Job Overview</div>
        <div class="section-content">
            <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
        </div>
        <?php if (!empty($job['tags'])): ?>
            <div class="section-title">Tags</div>
            <div class="section-content">
                <?php
                $tags = explode(',', $job['tags']);
                foreach ($tags as $tag) {
                    echo '<span class="tag">' . htmlspecialchars(trim($tag)) . '</span>';
                }
                ?>
            </div>
        <?php endif; ?>
        <div class="apply-button">
            <button><a href="apply.php?id=<?php echo $job['id']; ?>">Apply now</a></button>
        </div>
    </div>
    <?php require("footer.inc"); ?>
</body>
</html>
<?php 
$stmt->close();
$conn->close();
?>
