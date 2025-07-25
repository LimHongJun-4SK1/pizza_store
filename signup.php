<?php
// filepath: c:\xampp\htdocs\pizza_store\signup.php
session_start();
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$email || !$password) {
    echo "<script>alert('All fields are required!');window.history.back();</script>";
    exit();
}

$conn = new mysqli("localhost", "root", "", "pizza_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if username already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('Username already exists!');window.history.back();</script>";
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed_password, $email);

if ($stmt->execute()) {
    $_SESSION['user'] = $username;
    echo "<script>alert('Sign up successful! You are now logged in.');window.location.href='index.html';</script>";
} else {
    echo "<script>alert('Sign up failed!');window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>