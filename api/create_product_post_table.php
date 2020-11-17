<?php

include'connect.php';

$sql = "CREATE TABLE products_posts (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
price VARCHAR(50),
phone VARCHAR(30),
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table products_posts created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
