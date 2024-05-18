$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

if (!$email) {
    echo "Invalid email format.";
    exit();
}

$password = $_POST['password'];
if (strlen($password) < 6) {
    echo "Password must be at least 6 characters.";
    exit();
}
