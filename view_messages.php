<?php
// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza_store"; // Replace with your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all messages
$sql = "SELECT * FROM comment ORDER BY no DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Messages</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      background-color: #fff;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    h1 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <h1>Submitted Messages</h1>

  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['no']) ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['subject']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No messages found.</p>
  <?php endif; ?>

  <?php $conn->close(); ?>
</body>
</html>
