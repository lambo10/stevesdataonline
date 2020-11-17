<?php

include'connect.php';
$networkProvider = $_GET["networkProvider"];
$serviceType = $_GET["serviceType"];

$handle2 = "SELECT * FROM profits WHERE serviceType='$serviceType' AND network='$networkProvider'";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}

?>