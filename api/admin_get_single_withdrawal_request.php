<?php

include'connect.php';

$id = $_GET["id"];
session_start();
$email = $_SESSION["email"];

$handle2 = "SELECT id,email,amount,accountName,bankName,accountNo,date FROM commission_withdrawal WHERE id='$id'";
$result2 = $conn->query($handle2);
$dbData = array();
if(verifyAdmin($conn,$email) == 1){
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $dbData[]=$row;
        }
        echo json_encode($dbData);
    }
}

function verifyAdmin($conn,$email){
    $handle2 = "SELECT email  FROM admin_users WHERE email='$email'";
    $result2 = $conn->query($handle2);
    $exisit=0;
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
         $big4 = $row["email"];
         
        if($email==$big4){
        $exisit = $exisit+1;
        }
        }
    }
    return $exisit;
}

?>