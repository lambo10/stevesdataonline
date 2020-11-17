<?php

include'connect.php';

$sql = "CREATE TABLE reset_key (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(30),
code VARCHAR(10),
expirey_date DATETIME,
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table reset_key created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
