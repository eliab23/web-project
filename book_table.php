<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $people = $_POST["people"];
    $name = $_POST["name"];
    $name = $_POST["name"];
    
    if (!empty($name) && !empty($email) && !empty($phone)) {
        $sql = "INSERT INTO BOOKINGS (name, email, phone, date, time,people)
        VALUES ('$name', '$email', '$phone', '$date', '$time', '$people')";
        
        if ($conn->query($sql) === TRUE) {
              $message = "Table booked successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
        
    } else {
        $message = "please fill all fields.";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bool a Table</title>
        <link rel="stylesheet" href="style.css">
        <style>
        body {
            background-image: url('image/book.webp');
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
        .order-box p {
            text-align: center;
            color: #28a745;
        }
        .order-box p.error {
            color: #dc3545;
        }
        .order-box button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    </head>
    <body>

        <div class="order-box">
            <h2>Book a Table</h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="name" placeholder="Your Name" required><br><br>
                <input type="email" name="email" placeholder="Your Email" required><br><br>
                <input type="text" name="phone" placeholder="Your Phone" required><br><br>
                <input type="date" name="date" required><br><br>
                <input type="time" name="time" required><br><br>
                <input type="number" name="people" placeholder="Number of People" required><br><br>
                <button type="submit">Book Now</button>
            </form>

    </body>
</html>