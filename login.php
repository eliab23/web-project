<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: index.php");
            exit();
        } else {
            $message = "❌ Wrong password";
        }
    } else {
        $message = "❌ User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('image/log.jpg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
        body h2{
            margin-bottom: 20px;
            color: white;

        }
        form {
            display: flex;
            flex-direction: column;
            width: 300px;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
            .message {
                color: red;
                margin-bottom: 15px;
            }   
        
    </style>
</head>
<body>

<h2>Login</h2>

<?php if ($message): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>
