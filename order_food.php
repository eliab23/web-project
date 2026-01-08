<?php
include "db.php";
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $customer_name = $_POST['customer_name'];
    $food_name = $_POST['food_name'];
    $quantity = $_POST['quantity'];

    if ($customer_name != "" && $food_name != "" && $quantity > 0) {
        $sql = "INSERT INTO food_orders (customer_name, food_name, quantity) 
        VALUES ('$customer_name', '$food_name', '$quantity')";

        if ($conn->query($sql)) {
            $message = "Order placed successfully!";
        } else {
            $message = "Database error";
        }
    } else {
        $message = "Please fill all fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book.css">
    <title>Order Food</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('image/ord.webp');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .order-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .order-box h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #343a40;
        }
        .order-box input, .order-box button {
            width: 100%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="order-box">
        <h2>Order Food</h2>

        <?php if ($message ): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="customer_name" placeholder="Your Name" required>
             
            <input type="text" name="food_name" placeholder="Food Name" required>

            <input type="number" name="quantity" placeholder="Quantity" min="1" required>
            <button type="submit">Place Order</button>
        </form>

    </div>
</body>
</html>