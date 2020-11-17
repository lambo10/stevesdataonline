<?php

include'connect.php';

$handle2 = "SELECT * FROM services WHERE serviceType='DATA' ORDER BY id DESC";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}

?>