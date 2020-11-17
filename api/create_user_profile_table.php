<?php

include'connect.php';

$sql = "CREATE TABLE users (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30),
email VARCHAR(30),
phone VARCHAR(30),
AccBalance TEXT DEFAULT 0,
password VARCHAR(30),
whoReferredID VARCHAR(50),
referralID VARCHAR(50),
gender VARCHAR(30),
state VARCHAR(30),
minimun_1k_fund INT(2) DEFAULT 0,
commission TEXT DEFAULT 0,
apiKey TEXT DEFAULT 0,
accType VARCHAR(30) DEFAULT 'Enduser',
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
