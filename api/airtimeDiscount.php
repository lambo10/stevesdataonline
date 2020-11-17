<?php

include'connect.php';

$sql = "CREATE TABLE network (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
