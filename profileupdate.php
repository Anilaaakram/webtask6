<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET email=?";

    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        $sql .= ", password=?";
    }

    $sql .= " WHERE id=?";

    $stmt = $conn->prepare($sql);
    if (!empty($password)) {
        $stmt->bind_param("ssi", $email, $password_hashed, $user_id);
    } else {
        $stmt->bind_param("si", $email, $user_id);
    }

    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
