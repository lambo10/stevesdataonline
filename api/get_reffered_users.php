<?php

include'connect.php';
session_start();
$email = $_SESSION["email"];
$refID = $_SESSION["refID"];

$handle2 = "SELECT name,email,reg_date FROM users WHERE whoReferredID='$refID' ORDER BY id DESC";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}

?>