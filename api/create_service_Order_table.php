<?php

include'connect.php';

$sql = "CREATE TABLE service_Order (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
cost VARCHAR(30) DEFAULT 0,
type TEXT,
satisfied INT(2) DEFAULT 0,
meter_pnone_iuc_No VARCHAR(30),
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table service_Order created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
