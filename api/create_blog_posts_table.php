<?php

include'connect.php';

$sql = "CREATE TABLE blog_posts (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100),
author VARCHAR(30),
body TEXT,
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table blog_posts created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
