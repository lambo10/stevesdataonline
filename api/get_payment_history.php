<?php

include'connect.php';
session_start();
$email = $_SESSION["email"];

$handle2 = "SELECT id,refID,cost,date FROM transactions WHERE userEmail='$email' AND (type='AIRTIME' || type='DATA' || type='TV_SUB' || type='POWER' || type='PRINT_RECHARGE') ORDER BY id DESC";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}

?>