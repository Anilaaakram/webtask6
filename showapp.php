<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql_jobs = "SELECT * FROM jobs WHERE recruiter_id='$user_id'";
$result_jobs = $conn->query($sql_jobs);

$sql_apps = "SELECT a.id, a.job_id, a.candidate_name, a.candidate_experience, j.title FROM applications a JOIN jobs j ON a.job_id=j.id WHERE a.recruiter_id='$user_id'";
$result_apps = $conn->query($sql_apps);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <h2>Posted Jobs</h2>
    <ul>
        <?php
        if ($result_jobs->num_rows > 0) {
            while ($row = $result_jobs->fetch_assoc()) {
                echo "<li>" . $row['title'] . " - " . $row['salary'] . "</li>";
            }
        } else {
            echo "<li>No jobs posted.</li>";
        }
        ?>
    </ul>
    <h2>Post a New Job</h2>
    <form method="POST" action="post_job.php">
        <label for="title">Job Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="experience">Experience:</label>
        <input type="text" id="experience" name="experience" required>
        <label for="incentive">Incentive (PKR):</label>
        <input type="number" id="incentive" name="incentive" required>
        <button type="submit">Post Job</button>
    </form>

    <h2>Applications</h2>
    <ul>
        <?php
        if ($result_apps->num_rows > 0) {
            while ($row = $result_apps->fetch_assoc()) {
                echo "<li>Job: " . $row['title'] . " - Candidate: " . $row['candidate_name'] . " (" . $row['candidate_experience'] . ")</li>";
            }
        } else {
            echo "<li>No applications.</li>";
        }
        ?>
    </ul>
</body>
</html>
