<?php
include 'db_connection.php';

function distributeIncentive($job_id, $candidate_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT incentive, recruiter_id FROM jobs WHERE id=?");
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $stmt->bind_result($incentive, $job_recruiter_id);
    $stmt->fetch();
    $stmt->close();

    $candidate_recruiter_id = $_SESSION['user_id'];

    $admin_share = $incentive * 0.2;
    $job_recruiter_share = $incentive * 0.4;
    $candidate_recruiter_share = $incentive * 0.4;

    $stmt = $conn->prepare("INSERT INTO incentives (job_id, candidate_id, recruiter_id, amount, admin_share, job_recruiter_share, candidate_recruiter_share) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiddd", $job_id, $candidate_id, $candidate_recruiter_id, $incentive, $admin_share, $job_recruiter_share, $candidate_recruiter_share);

    if ($stmt->execute()) {
        echo "Incentive distributed successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
