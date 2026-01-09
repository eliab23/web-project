<?php
session_start();
include "db.php";

// protect page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM food_orders ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Food Orders</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 90%;
            margin: 40px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #f4f4f4;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

    </style>
</head>
<body>

<h2 style="text-align:center;">Food Orders</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Food</th>
        <th>Qty</th>
        <th>Payment</th>
        <th>Date</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row["id"] ?></td>
        <td><?= $row["customer_name"] ?></td>
        <td><?= $row["food_name"] ?></td>
        <td><?= $row["quantity"] ?></td>
        <td><?= $row["payment_method"] ?></td>
        <td><?= $row["created_at"] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
