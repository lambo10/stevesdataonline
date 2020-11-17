<?php

include'connect.php';

$sql = "CREATE TABLE comments (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30),
email VARCHAR(30),
comment TEXT,
postID INT(10),
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table comments created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
