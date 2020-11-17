<?php

include'connect.php';
$network1 = $_GET["network1"];
$network2 = $_GET["network2"];
$accessKey = $_GET["key"];

if(strcmp($accessKey,"uraj1i2568") == 0 || strcmp($accessKey,"vdrat3t2356") == 0){
    $handle2 = "SELECT * FROM data_airtime_purchase_bucket WHERE status='0' AND (network='$network1' OR network='$network2') LIMIT 1";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $dbData[]=$row;
        update_row_status($conn,$row["id"]);
    }
    echo "{results:".json_encode($dbData)."}";
}else{
    echo "{results:[]}";
}
}else{
    echo "Access Denied";
}

function update_row_status($conn,$id){
    $updateHandle = "UPDATE data_airtime_purchase_bucket SET status=1 WHERE id='$id'";
    if ($conn->query($updateHandle) === TRUE) {
    }
}


?>