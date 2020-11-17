<?php

include'connect.php';

$sql = "CREATE TABLE phonebook (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
bookname VARCHAR(50),
recipients TEXT,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table phonebook created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
