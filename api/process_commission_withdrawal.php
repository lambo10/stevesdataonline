<?php
include'connect.php';

$reciverEmail = $_GET["reciverEmail"];
$amount = $_GET["amount"];
$accountName = $_GET["accountName"];
$bankName = $_GET["bankName"];
$accountNo = $_GET["accountNo"];

session_start();
$email = $_SESSION["email"];

$handle2 = "SELECT commission FROM users WHERE email='$email'";
$result2 = $conn->query($handle2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $AccBalance = $row["commission"];
        if((int)$AccBalance < (int)$amount){
            echo "100013";
        }else{
            $up_accountbalance = (int)$AccBalance - (int)$amount;
            $updateHandle = "UPDATE users SET commission='$up_accountbalance' WHERE email='$email'";
        if ($conn->query($updateHandle) === TRUE) {

            insertWithdrawal($conn,$email,$amount,$accountName,$bankName,$accountNo);

        } else {
        echo "100012";
        }
           
        }
        
    }
}else{
    echo "100111";
}

function insertTransaction($conn,$userEmail,$cost,$type,$refID){
    
    $sql = "INSERT INTO transactions (userEmail,cost,type,refID)
    VALUES ('$userEmail','$cost','$type','$refID')";
    
    if ($conn->query($sql) === TRUE) {
        echo "11111";
      }else{
          echo "100111";
      }
    
}

function insertWithdrawal($conn,$email,$amount,$accountName,$bankName,$accountNo){
    $sql = "INSERT INTO commission_withdrawal (email,amount,accountName,bankName,accountNo)
    VALUES ('$email','$amount','$accountName','$bankName','$accountNo')";
    
    if ($conn->query($sql) === TRUE) {
        insertTransaction($conn,$email,$amount,"COMISSION WITHDRAWAL",genarateToken(7));
      }else{
          echo "100111";
      }
}

function genarateToken($len = 32){
    return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }
?>