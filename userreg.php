<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email, role, status) VALUES ('$username', '$password', '$email', 'recruiter', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. Please wait for admin approval.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
