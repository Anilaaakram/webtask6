<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM jobs WHERE recruiter_id='$user_id'";
$result = $conn->query($sql);
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
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
</body>
</html>
