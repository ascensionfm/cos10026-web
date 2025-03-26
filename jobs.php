<?php
    session_start();
    require("jobs_data.php");

    $searchKeyword = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
    $filterLocation = isset($_GET['location']) ? $_GET['location'] : '';
    $filterSalary = isset($_GET['salary']) ? $_GET['salary'] : '';

    function filterSalary($jobSalary, $filterSalary) {
        if ($filterSalary === '') return true;
        $salaryMap = [
            "Up to 10M" => 10,
            "10M - 30M" => 30,
            "30M - 50M" => 50,
            "Above 50M" => 51
        ];
        preg_match('/\d+/', $jobSalary, $matches);
        $jobAmount = isset($matches[0]) ? (int)$matches[0] : 0;

        if ($filterSalary === "Above 50M") {
            return $jobAmount >= $salaryMap[$filterSalary];
        }
        return $jobAmount <= $salaryMap[$filterSalary];
    }
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
                <input type="text" placeholder="Search" name="search" value="<?php echo htmlspecialchars($searchKeyword); ?>">
            </div>
            <select name="location">
                <option value="">Location</option>
                <?php
                $locations = ["Ha Noi", "Đa Nang", "TP HCM", "Can Tho", "Hai Phong", "Ca Mau", "Quang Ninh", "International"];
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
            <button class="search-btn" type="submit">Search</button>
        </form>

        <div class="jobs-grid">
            <?php
            $order = 1;
            $hasResults = false;
            foreach ($jobs as $job) {
                $job["tags"] = isset($job["tags"]) && is_array($job["tags"]) ? $job["tags"] : [];

                // Filter theo keyword
                $titleMatch = stripos($job["title"], $searchKeyword) !== false;
                $tagMatch = array_filter($job["tags"], function($tag) use ($searchKeyword) {
                    return stripos($tag, $searchKeyword) !== false;
                });

                if (
                    ($filterLocation === '' || $job["location"] === $filterLocation) &&
                    ($filterSalary === '' || filterSalary($job["salary"], $filterSalary)) &&
                    ($searchKeyword === '' || $titleMatch || !empty($tagMatch))
                ) {
                    $hasResults = true;

                    echo '<div class="job-card" style="--order: ' . $order . '">
                        <div class="job-header">
                            <h3 class="job-title">' . htmlspecialchars($job["title"]) . '</h3>
                            <span class="hot-tag">' . htmlspecialchars($job["tag"]) . '</span>
                        </div>
                        <div class="job-info">
                            <span>' . htmlspecialchars($job["salary"]) . '</span>
                            <span>' . htmlspecialchars($job["type"]) . '</span>
                        </div>
                        <div class="job-info">
                            <span>' . htmlspecialchars($job["level"]) . '</span>
                            <span>' . htmlspecialchars($job["location"]) . '</span>
                        </div>';
                    
                    if (!empty($job["tags"])) {
                        echo '<div class="tags">';
                        foreach ($job["tags"] as $tag) {
                            echo '<span class="tag">' . htmlspecialchars($tag) . '</span>';
                        }
                        echo '</div>';
                    }
                    
                    echo '<a href="job_detail/' . htmlspecialchars($job["link"]) . '" class="view-more">View more</a>
                    </div>';
                    $order++;
                }
            }

            if (!$hasResults) {
                echo '<p>No jobs found. Please try again with different filters.</p>';
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
