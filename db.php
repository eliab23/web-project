<?php
$host = 'localhost';
$dbname = 'cafeteria';
$username = 'root'; // default in xammp
$password = "";   // default in xammp

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>