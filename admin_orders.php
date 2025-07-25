<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "pizza_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders
$sql = "SELECT id, items, total_price, created_at FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Orders</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 30px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f4b41a; color: #fff; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Order List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Items</th>
            <th>Total Price</th>
            <th>Order Time</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['items']) ?></td>
                    <td>RM<?= number_format($row['total_price'], 2) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No orders found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>