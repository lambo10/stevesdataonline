<?php

include'connect.php';

$sql = "CREATE TABLE admin_users (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30),
email VARCHAR(30),
password VARCHAR(30),
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table admin_users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
