<?php

include'connect.php';
session_start();
$email = $_SESSION["email"];

$handle2 = "SELECT * FROM users WHERE email='$email'";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}

?>