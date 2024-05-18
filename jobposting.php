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

    $sql = "INSERT INTO jobs (recruiter_id, title, salary, description, experience, incentive) VALUES ('$recruiter_id', '$title', '$salary', '$description', '$experience', '$incentive')";

    if ($conn->query($sql) === TRUE) {
        echo "Job posted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
