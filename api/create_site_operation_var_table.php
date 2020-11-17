<?php

include'connect.php';

$sql = "CREATE TABLE site_operation_var (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
operation_name VARCHAR(30),
instruction_or_data TEXT,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table site_operation_var created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
