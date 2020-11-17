<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
$sql = "CREATE DATABASE vtuexchange";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
}else {
    echo "Error creating database: " . $conn->error;
}
?>