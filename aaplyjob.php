<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$recruiter_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $candidate_name = $_POST['candidate_name'];
    $candidate_experience = $_POST['candidate_experience'];

    $stmt = $conn->prepare("INSERT INTO applications (job_id, recruiter_id, candidate_name, candidate_experience, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iiss", $job_id, $recruiter_id, $candidate_name, $candidate_experience);

    if ($stmt->execute()) {
        echo "Application submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
