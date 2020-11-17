<?php

include'connect.php';
$id = $_GET["id"];

$handle2 = "SELECT * FROM transactions WHERE id='$id'";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}

?>