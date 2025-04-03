<?php
    session_start();
    require("settings.php"); 
    $conn = new mysqli($host, $user, $pwd, $sql_db);

    $searchKeyword = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
    $filterLocation = isset($_GET['location']) ? $_GET['location'] : '';
    $filterSalary = isset($_GET['salary']) ? $_GET['salary'] : '';

    $queryConditions = array();
    $queryParams = array();
    $queryParamTypes = "";

    if ($searchKeyword !== "") {
        $queryConditions[] = "(LOWER(title) LIKE ? OR LOWER(tags) LIKE ?)";
        $likeSearch = "%" . $searchKeyword . "%";
        $queryParams[] = $likeSearch;
        $queryParams[] = $likeSearch;
        $queryParamTypes .= "ss";
    }
    if ($filterLocation !== "") {
        $queryConditions[] = "location = ?";
        $queryParams[] = $filterLocation;
        $queryParamTypes .= "s";
    }
    if ($filterSalary !== "") {
        // Salary filter fix
        if (strpos($filterSalary, 'Up to') !== false) {
            $maxSalary = (int) filter_var($filterSalary, FILTER_SANITIZE_NUMBER_INT);
            $queryConditions[] = "salary <= ?";
            $queryParams[] = $maxSalary;
            $queryParamTypes .= "i"; 
        } elseif (strpos($filterSalary, '-') !== false) {
            list($minSalary, $maxSalary) = explode('-', $filterSalary);
            $minSalary = (int) filter_var($minSalary, FILTER_SANITIZE_NUMBER_INT);
            $maxSalary = (int) filter_var($maxSalary, FILTER_SANITIZE_NUMBER_INT);
            $queryConditions[] = "salary BETWEEN ? AND ?";
            $queryParams[] = $minSalary;
            $queryParams[] = $maxSalary;
            $queryParamTypes .= "ii";
        }
    }

    $query = "SELECT * FROM jobs";
    if (count($queryConditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $queryConditions);
    }

    $stmt = $conn->prepare($query);
    if (count($queryParams) > 0) {
        $stmt->bind_param($queryParamTypes, ...$queryParams);
    }
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs page - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style-jobs.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php require("header.inc"); ?>
    <div class="container">
        <form class="search-container" method="GET">
            <div class="search-box">
                <input type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($searchKeyword); ?>">
            </div>
            <select name="location">
                <option value="">Location</option>
                <?php
                $locations = ["Ha Noi", "Da Nang", "Ho Chi Minh City", "Can Tho", "Hai Phong", "Ca Mau", "Quang Ninh", "International"];
                foreach ($locations as $location) {
                    echo '<option value="' . $location . '"' . ($filterLocation === $location ? ' selected' : '') . '>' . $location . '</option>';
                }
                ?>
            </select>
            <select name="salary">
                <option value="">Salary</option>
                <?php
                $salaryRanges = ["Up to 10M", "10M - 30M", "30M - 50M", "Above 50M"];
                foreach ($salaryRanges as $range) {
                    echo '<option value="' . $range . '"' . ($filterSalary === $range ? ' selected' : '') . '>' . $range . '</option>';
                }
                ?>
            </select>
            <button type="submit" class="search-btn">Search</button>
        </form>

        <div class="jobs-grid">
            <?php while ($job = $result->fetch_assoc()): ?>
                <div class="job-card">
                    <div class="job-header">
                        <h3 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h3>
                        <span class="hot-tag"><?php echo htmlspecialchars($job['tag']); ?></span>
                    </div>
                    <div class="job-info">
                        <span><?php echo htmlspecialchars($job['salary']); ?></span>
                        <span><?php echo htmlspecialchars($job['type']); ?></span>
                    </div>
                    <div class="job-info">
                        <span><?php echo htmlspecialchars($job['level']); ?></span>
                        <span><?php echo htmlspecialchars($job['location']); ?></span>
                    </div>
                    <div class="tags">
                        <?php foreach (explode(',', $job['tags']) as $tag): ?>
                            <span class="tag"><?php echo htmlspecialchars(trim($tag)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <a href="job_detail.php?id=<?php echo $job['id']; ?>" class="view-more">View more</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php require("footer.inc"); ?>
</body>
</html>
<?php $conn->close(); ?>