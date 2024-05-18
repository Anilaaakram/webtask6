<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve_user_id'])) {
    $user_id = $_POST['approve_user_id'];

    $sql = "UPDATE users SET status='approved' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "User approved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
