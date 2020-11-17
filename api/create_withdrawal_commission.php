<?php

include'connect.php';

$sql = "CREATE TABLE commission_withdrawal (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(30),
amount VARCHAR(10),
accountName VARCHAR(100),
bankName VARCHAR(100),
accountNo VARCHAR(100),
setteled INT(2) DEFAULT 0,
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table commission_withdrawal created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
