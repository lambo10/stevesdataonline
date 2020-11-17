<?php

include'connect.php';
session_start();
$email = $_SESSION["email"];
$refID = $_SESSION["refID"];
$commission = "";
$handle2 = "SELECT commission FROM users WHERE email='$email'";
$result2 = $conn->query($handle2);

if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $commission = $row["commission"];
    }
}

$handle3 = "SELECT minimun_1k_fund FROM users WHERE whoReferredID='$refID'";
$result3 = $conn->query($handle3);
$referral_SignUps = 0;
$successful_referral = 0 ;
if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc()) {
        $minimun_1k_fund = $row["minimun_1k_fund"];
        if((int)$minimun_1k_fund == 1){
            $successful_referral++;
        }
        $referral_SignUps++;
    }
}

echo '{"commission":"'.$commission.'","referral_SignUps":"'.$referral_SignUps.'","successful_referral":"'.$successful_referral.'"}';

?>