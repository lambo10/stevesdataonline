<?php

include'connect.php';

$sql = "CREATE TABLE adverts (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100),
ad_link TEXT,
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table adverts created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
