<?php

include'connect.php';

$numberOfMsg = $_GET["numberOfMsg"];

$handle2 = "SELECT price_per_unitIn FROM bulkSmsPricing WHERE fromIn >= '$numberOfMsg' AND toIn <= '$numberOfMsg'";
$result2 = $conn->query($handle2);
$dbData = array();

    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            echo $row["price_per_unitIn"];
        }
    }


?>