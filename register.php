<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($name != "" && $email != "" && $password != "") {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password)
                VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql)) {
              header("Location: login.php");
              exit();
       }
         else {
            $message = "❌ Email already exists!";
        }

    } else {
        $message = "❌ All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('image/reg.jpg');
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
        
    </style>
</head>
<body>

<h2>Register</h2>

<?php if ($message): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
</form>

<p>
    Already have an account?  
    <a href="login.php"> Login</a>
</p>

</body>
</html>
