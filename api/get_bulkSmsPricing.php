<?php

include'connect.php';

$handle2 = "SELECT fromIn,toIn,price_per_unitIn FROM bulkSmsPricing";
$result2 = $conn->query($handle2);
$dbData = array();

    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $dbData[]=$row;
        }
        echo json_encode($dbData);
    }


?>