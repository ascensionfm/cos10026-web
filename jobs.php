<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Include settings.php to get the database connection
require("settings.php");

// Get filter values from GET parameters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filterLocation = isset($_GET['location']) ? trim($_GET['location']) : '';
$filterSalary = isset($_GET['salary']) ? trim($_GET['salary']) : '';

// Build dynamic query conditions
$queryConditions = array();
$queryParams = array();
$queryParamTypes = "";

if ($search != "") {
    // Search in title OR tags
    $queryConditions[] = "(title LIKE ? OR tags LIKE ?)";
    $likeSearch = "%" . $search . "%";
    $queryParams[] = $likeSearch;
    $queryParams[] = $likeSearch;
    $queryParamTypes .= "ss";
}

if ($filterLocation != "") {
    $queryConditions[] = "location = ?";
    $queryParams[] = $filterLocation;
    $queryParamTypes .= "s";
}

if ($filterSalary != "") {
    $queryConditions[] = "salary = ?";
    $queryParams[] = $filterSalary;
    $queryParamTypes .= "s";
}

$query = "SELECT * FROM jobs";
if (count($queryConditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $queryConditions);
}

if (count($queryParams) > 0) {
    $stmt = $conn->prepare($query);
    $stmt->bind_param($queryParamTypes, ...$queryParams);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs page - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/style-jobs.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php require("header.inc"); ?>
    <div class="container">
        <!-- Search form -->
        <form class="search-container" method="GET" action="jobs.php">
            <div class="search-box">
                <input type="text" placeholder="Search" name="search" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <select name="location">
                <option value="">Location</option>
                <?php
                $locations = ["Ha Noi", "Đa Nang", "TP HCM", "Can Tho", "Hai Phong", "Ca Mau", "Quang Ninh", "International"];
                foreach ($locations as $location) {
                    $selected = ($filterLocation === $location) ? ' selected' : '';
                    echo '<option value="' . $location . '"' . $selected . '>' . $location . '</option>';
                }
                ?>
            </select>
            <select name="salary">
                <option value="">Salary</option>
                <?php
                $salaryRanges = ["Up to 10M", "10M - 30M", "30M - 50M", "Above 50M"];
                foreach ($salaryRanges as $range) {
                    $selected = ($filterSalary === $range) ? ' selected' : '';
                    echo '<option value="' . $range . '"' . $selected . '>' . $range . '</option>';
                }
                ?>
            </select>
            <button class="search-btn" type="submit">Search</button>
        </form>

        <div class="jobs-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="job-card">';
                    echo '<div class="job-header">';
                    echo '<h3 class="job-title">' . htmlspecialchars($row['title']) . '</h3>';
                    if (isset($row['hot']) && $row['hot'] == 1) {
                        echo '<span class="hot-tag">Hot</span>';
                    }
                    echo '</div>';
                    echo '<div class="job-info">';
                    echo '<span>' . htmlspecialchars($row['salary']) . '</span>';
                    echo '<span>' . htmlspecialchars($row['job_type']) . '</span>';
                    echo '</div>';
                    echo '<div class="job-info">';
                    echo '<span>' . htmlspecialchars($row['level']) . '</span>';
                    echo '<span>' . htmlspecialchars($row['location']) . '</span>';
                    echo '</div>';
                    echo '<div class="tags">';
                    if (!empty($row['tags'])) {
                        $tags = explode(',', $row['tags']);
                        foreach ($tags as $tag) {
                            echo '<span class="tag">' . htmlspecialchars(trim($tag)) . '</span>';
                        }
                    }
                    echo '</div>';
                    echo '<a href="job_detail.php?id=' . $row['id'] . '" class="view-more">View more</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No jobs available</p>";
            }
            ?>
        </div>
        <?php
            require_once 'settings.php';
            $conn = new mysqli($host, $user, $pwd, $sql_db);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

        ?>
    </div>
    <?php require("footer.inc"); ?>
</body>
</html>
<?php $conn->close(); ?>
