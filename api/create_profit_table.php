<?php

include'connect.php';

$sql = "CREATE TABLE profits (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
network VARCHAR(30),
serviceType VARCHAR(30),
profit VARCHAR(10),
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table profits created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
