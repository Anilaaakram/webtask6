<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recruiter_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $salary = $_POST['salary'];
    $description = $_POST['description'];
    $experience = $_POST['experience'];
    $incentive = $_POST['incentive'];

    $stmt = $conn->prepare("INSERT INTO jobs (recruiter_id, title, salary, description, experience, incentive) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isdssd", $recruiter_id, $title, $salary, $description, $experience, $incentive);

    if ($stmt->execute()) {
        echo "Job posted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
