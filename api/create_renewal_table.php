<?php

include'connect.php';

$sql = "CREATE TABLE renewal (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userEmail VARCHAR(30),
network VARCHAR(30),
cost VARCHAR(30),
duration VARCHAR(30),
serviceType VARCHAR(30),
meter_pnone_iuc_No VARCHAR(30),
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table renewal created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
