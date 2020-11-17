<?php

include'connect.php';

$sql = "CREATE TABLE bulksmsHistory (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(300),
body TEXT,
status INT(10) DEFAULT 0,
numbers TEXT,
cost INT(100),
price_per_unit INT(100),
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table bulksmsHistory created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
c