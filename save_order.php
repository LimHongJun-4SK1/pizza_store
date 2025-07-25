<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = $_POST['items'] ?? '';
    $total_price = $_POST['total_price'] ?? 0;

    $conn = new mysqli("localhost", "root", "", "pizza_store");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO orders (items, total_price) VALUES (?, ?)");
    $stmt->bind_param("sd", $items, $total_price);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "error: Invalid request";
}
?>