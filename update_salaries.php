<?php
require("settings.php");

// Define
$jobs = [
    [
        "title" => "Sales Executive (International Market)",
        "salary" => 500000000 
    ],
    [
        "title" => "Sales Manager – HCM",
        "salary" => 25000000 
    ],
    [
        "title" => "Senior AI Engineer",
        "salary" => 50000000 
    ],
    [
        "title" => "Technical Project Manager",
        "salary" => 40000000 
    ],
    [
        "title" => "Senior Solutions Architect / Consultant",
        "salary" => 40000000 
    ],
    [
        "title" => "Intern Project Coordinator",
        "salary" => 4000000 
    ],
    [
        "title" => "Production Support",
        "salary" => 45000000 
    ],
    [
        "title" => "Mid/Senior International Sales",
        "salary" => null
    ],
    [
        "title" => "Bridge System Engineer (BrSE) - Japan",
        "salary" => 90000000 
    ]
];

// Update 
foreach ($jobs as $job) {
    if ($job['salary'] !== null) {
        $stmt = $conn->prepare("UPDATE job_listings SET salary = ? WHERE title = ?");
        $stmt->bind_param("is", $job['salary'], $job['title']);
        $stmt->execute();
    }
}

echo "Salaries updated successfully.";
$conn->close();
?>
