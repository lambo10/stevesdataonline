<?php

include'connect.php';

$sql = "CREATE TABLE bulkSmsPricing (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
fromIn VARCHAR(50),
toIn VARCHAR(50),
price_per_unitIn VARCHAR(50),
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table bulkSmsPricing created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
