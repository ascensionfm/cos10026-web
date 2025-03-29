<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management - Next_Gen Corporation</title>
    <link rel="icon" href="./images/logo1.ico">
    <link rel="stylesheet" href="./styles/style-join.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/manage.css">
</head>
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

<?php include 'header.inc'; ?>
<?php
require_once 'settings.php';

$conn = new mysqli($host, $user, $pwd, $sql_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM applications";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['application_id']) && isset($_POST['status'])) {
    $applicationId = $conn->real_escape_string($_POST['application_id']);
    $newStatus = $conn->real_escape_string($_POST['status']);
    $updateSql = "UPDATE applications SET status = '$newStatus' WHERE id = '$applicationId'";
    $conn->query($updateSql);
}

$options = ['Programming', 'Design', 'Marketing', 'Sales', 'Management', 'English', 'Japanese', 'Chinese', 'Other'];

// Handle filter inputs
$filterSkills = isset($_GET['filter_skills']) && is_array($_GET['filter_skills']) ? $_GET['filter_skills'] : [];
$filterJobReference = isset($_GET['filter_job_reference']) ? $_GET['filter_job_reference'] : '';
$filterName = isset($_GET['filter_name']) ? $_GET['filter_name'] : '';

// Build the SQL query with filters
$sql = "SELECT * FROM applications WHERE 1=1";

if (!empty($filterSkills)) {
    $skillConditions = [];
    foreach ($filterSkills as $skill) {
        $skillConditions[] = "FIND_IN_SET('" . $conn->real_escape_string($skill) . "', skills)";
    }
    $sql .= " AND (" . implode(" OR ", $skillConditions) . ")";
}

if (!empty($filterJobReference)) {
    $sql .= " AND job_reference LIKE '%" . $conn->real_escape_string($filterJobReference) . "%'";
}

if (!empty($filterName)) {
    $sql .= " AND (first_name LIKE '%" . $conn->real_escape_string($filterName) . "%' OR last_name LIKE '%" . $conn->real_escape_string($filterName) . "%')";
}

$result = $conn->query($sql);

// Display filter form
echo '<form method="GET" class="filter-form" style="margin-top: 100px; display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; text-align: center;">';
echo '<div style="flex: 1; min-width: 200px;">';
echo '<label for="filter_job_reference">Filter by Job Reference:</label><br>';
echo '<input type="text" name="filter_job_reference" id="filter_job_reference" value="' . htmlspecialchars($filterJobReference) . '">';
echo '</div>';
echo '<div style="flex: 1; min-width: 200px;">';
echo '<label for="filter_name">Filter by First or Last Name:</label><br>';
echo '<input type="text" name="filter_name" id="filter_name" value="' . htmlspecialchars($filterName) . '">';
echo '</div>';
echo '<div style="flex: 2; min-width: 300px;">';
echo '<label>Filter by Skills:</label><br>';

foreach ($options as $option) {
    $checked = in_array($option, $filterSkills) ? 'checked' : '';
    echo '<label style="display: inline-block; margin-right: 10px;"><input type="checkbox" name="filter_skills[]" value="' . htmlspecialchars($option) . '" ' . $checked . '> ' . htmlspecialchars($option) . '</label>';
}

echo '</div>';
echo '<div style="flex: 1; min-width: 100px; align-self: flex-end;">';
echo '<button type="submit">Apply Filters</button>';
echo '</div>';
echo '</form>';

if ($result->num_rows > 0) {
    echo '<div class="obj-width extra-space" style="display: flex; justify-content: center; margin-top: 20px;">';
    echo '<table class="styled-table" style="margin: 0 auto; border: 1px solid black; border-collapse: collapse;">';
    echo '<thead>';
    echo '<tr style="border: 1px solid black;">';
    echo '<th style="border: 1px solid black;">User ID</th>';
    echo '<th style="border: 1px solid black;">Job Reference</th>';
    echo '<th style="border: 1px solid black;">First Name</th>';
    echo '<th style="border: 1px solid black;">Last Name</th>';
    echo '<th style="border: 1px solid black;">Date of Birth</th>';
    echo '<th style="border: 1px solid black;">Gender</th>';
    echo '<th style="border: 1px solid black;">Street Address</th>';
    echo '<th style="border: 1px solid black;">Suburb</th>';
    echo '<th style="border: 1px solid black;">State</th>';
    echo '<th style="border: 1px solid black;">Postcode</th>';
    echo '<th style="border: 1px solid black;">Email</th>';
    echo '<th style="border: 1px solid black;">Phone</th>';
    echo '<th style="border: 1px solid black;">Skills</th>';
    echo '<th style="border: 1px solid black;">Other Skills</th>';
    echo '<th style="border: 1px solid black;">Photo</th>';
    echo '<th style="border: 1px solid black;">Application Date</th>';
    echo '<th style="border: 1px solid black;">Position Name</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr style="border: 1px solid black;">';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['user_id']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['job_reference']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['first_name']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['last_name']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['date_of_birth']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['gender']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['street_address']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['suburb']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['state']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['postcode']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['email']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['phone']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['skills']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['other_skills']) . '</td>';
        echo '<td style="border: 1px solid black;">';
        echo '<form method="POST" action="manage.php">';
        echo '<input type="hidden" name="application_id" value="' . htmlspecialchars($row['id']) . '">';
        echo '<select name="status" onchange="this.form.submit()">';
        $statusOptions = ['Under Review', 'Complete', 'Pending', 'Rejected'];
        foreach ($statusOptions as $statusOption) {
            $selected = ($row['status'] === $statusOption) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($statusOption) . '" ' . $selected . '>' . htmlspecialchars($statusOption) . '</option>';
        }
        echo '</select>';
        echo '</form>';
        echo '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['application_date']) . '</td>';
        echo '<td style="border: 1px solid black;">' . htmlspecialchars($row['position_name']) . '</td>';
        echo '<td style="border: 1px solid black; text-align: center;">';
        echo '<form method="POST" action="manage.php" onsubmit="return confirm(\'Are you sure you want to delete this application?\');">';
        echo '<input type="hidden" name="delete_application_id" value="' . htmlspecialchars($row['id']) . '">';
        echo '<button type="submit" name="delete_application" style="padding: 5px 10px; background-color: #f44336; color: white; border: none; border-radius: 3px; cursor: pointer;">Delete</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_application']) && isset($_POST['delete_application_id'])) {
            $applicationIdToDelete = $conn->real_escape_string($_POST['delete_application_id']);
            $deleteSql = "DELETE FROM applications WHERE id = '$applicationIdToDelete'";
            if ($conn->query($deleteSql) === TRUE) {
                echo '<p style="text-align: center; color: green;">Application with ID ' . htmlspecialchars($applicationIdToDelete) . ' has been deleted successfully.</p>';
                header('Location: manage.php');
                exit;
            } else {
                echo '<p style="text-align: center; color: red;">Error deleting application: ' . $conn->error . '</p>';
            }
        }
        echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<p>No applications found.</p>';
}
function deleteEOIsByJobReference($conn, $jobReference) {
    $jobReferenceToDelete = $conn->real_escape_string($jobReference);
    $deleteSql = "DELETE FROM applications WHERE job_reference = '$jobReferenceToDelete'";
    if ($conn->query($deleteSql) === TRUE) {
        echo '<p style="text-align: center; color: green;">EOIs with Job Reference "' . htmlspecialchars($jobReferenceToDelete) . '" have been deleted successfully.</p>';
        header('Location: manage.php');
            exit;
    } else {
        echo '<p style="text-align: center; color: red;">Error deleting EOIs: ' . $conn->error . '</p>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_eois']) && isset($_POST['delete_job_reference'])) {
    deleteEOIsByJobReference($conn, $_POST['delete_job_reference']);
}

echo '<form method="POST" action="manage.php">';
echo '<label for="delete_job_reference">Delete EOIs by Job Reference:</label>';
echo '<input type="text" name="delete_job_reference" id="delete_job_reference" required>';
echo '<button type="submit" name="delete_eois">Delete</button>';
echo '</form>';
echo '<div style="text-align: center; margin-top: 20px;">';
echo '<form method="POST" action="admin_logout.php">';
echo '<button type="submit" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer;">Logout</button>';
echo '</form>';
echo '</div>';
$conn->close();
?>
<?php include 'footer.inc'; ?>
