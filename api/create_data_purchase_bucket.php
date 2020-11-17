<?php

include'connect.php';

$sql = "CREATE TABLE data_airtime_purchase_bucket (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userEmail VARCHAR(30),
network VARCHAR(30),
phone VARCHAR(30),
type TEXT,
refID VARCHAR(30),
sms_usd_string TEXT,
status INT(2) DEFAULT 0,
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table data_airtime_purchase_bucket created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
