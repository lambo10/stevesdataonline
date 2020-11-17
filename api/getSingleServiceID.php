<?php

include'connect.php';
$networkProvider = $_GET["networkProvider"];
$serviceType = $_GET["serviceType"];

$handle2 = "SELECT id FROM services WHERE serviceType='$serviceType' AND network='$networkProvider'";
$result2 = $conn->query($handle2);
$output = "";
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $output = $row["id"];
    }
    echo $output;
}

?>