<?php

include'connect.php';

$sql = "CREATE TABLE newsletterEmail (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(30)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table newsletterEmail created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
