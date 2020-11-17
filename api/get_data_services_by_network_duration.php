<?php

include'connect.php';

$network = $_GET["network"];
$duration = $_GET["duration"];

if(strcmp($network,"mtn") == 0){
    $handle2 = "SELECT * FROM services WHERE serviceType='DATA' AND network='$network' AND validity='$duration' ORDER BY id DESC";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}
}else{
    $handle2 = "SELECT * FROM services WHERE serviceType='DATA' AND network='$network' AND validity='$duration'  ORDER BY id ASC";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
    }
    echo json_encode($dbData);
}
}

?>