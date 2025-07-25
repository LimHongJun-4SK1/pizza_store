<?php
session_start();
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$conn = new mysqli("localhost", "root", "", "pizza_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($hashed_password);

if ($stmt->fetch() && password_verify($password, $hashed_password)) {
    $_SESSION['user'] = $username;
    // Show alert and redirect
    echo "<script>alert('Login successfully!'); window.location.href='index.html';</script>";
    exit();
} else {
    echo "<script>alert('Invalid login!');window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
