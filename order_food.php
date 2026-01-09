<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}



include "db.php";
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $customer_name = $_POST['customer_name'];
    $food_name = $_POST['food_name'];
    $quantity = $_POST['quantity'];
    $payment_method = $_POST['payment_method'];

    if ($customer_name != "" && $food_name != "" && $quantity > 0) {
        $sql = "INSERT INTO food_orders (customer_name, food_name, quantity, payment_method) 
        VALUES ('$customer_name', '$food_name', '$quantity', '$payment_method')";

        if ($conn->query($sql)) {
            header("Location: order_success.php");
            exit(); 
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
        .order-box button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .order-box button:hover {
            background-color: #218838;
        }
         .order-box p {
            text-align: center;
            color: #dc3545;
         }
         .order-box p.success {
            color: #28a745;
         }
         .order-box select {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            box-sizing: border-box;
            font-size: 16px;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
         }
         .order-box select:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
         }
         .order-box input:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
         }
         .order-box button:focus {
            outline: none;
         }
         .order-box p {
            font-weight: bold;
         }
         .order-box p.success {
            color: #28a745;
         }
         .order-box p.error {
            color: #dc3545;
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

            <select name="payment_method" required>
                <option value="" disabled selected>Select Payment Method</option>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash_on_delivery">Cash on Delivery</option>
            </select>

            <button type="submit">Place Order</button>
        </form>

    </div>
</body>
</html>