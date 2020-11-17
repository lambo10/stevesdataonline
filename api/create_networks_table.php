<?php

include'connect.php';

$sql = "CREATE TABLE networks (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30),
status INT(2) DEFAULT 0,
type VARCHAR(30),
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table networks created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
