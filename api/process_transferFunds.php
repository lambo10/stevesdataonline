<?php
include'connect.php';

$reciverEmail = $_GET["reciverEmail"];
$amount = $_GET["amount"];
session_start();
$email = $_SESSION["email"];

$handle2 = "SELECT AccBalance FROM users WHERE email='$email'";
$result2 = $conn->query($handle2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $AccBalance = $row["AccBalance"];
        if((int)$AccBalance < (int)$amount){
            echo "100013";
        }else{
            $up_accountbalance = (int)$AccBalance - (int)$amount;
            $updateHandle = "UPDATE users SET AccBalance='$up_accountbalance' WHERE email='$email'";
        if ($conn->query($updateHandle) === TRUE) {

            $handle3 = "SELECT AccBalance FROM users WHERE email='$reciverEmail'";
            $result3 = $conn->query($handle3);
            if ($result3->num_rows > 0) {
                while($row = $result3->fetch_assoc()) {
                    $reciver_AccBalance = $row["AccBalance"];
                    $up_reciver_accountbalance = (int)$reciver_AccBalance + (int)$amount;
                    $updateHandle = "UPDATE users SET AccBalance='$up_reciver_accountbalance' WHERE email='$reciverEmail'";
                    if ($conn->query($updateHandle) === TRUE) {
                        echo "11111";
                        insertTransaction($conn,$email,$amount,"TRANSFER",genarateToken(7));
                    } else {
                    echo "100015";
                    }
                }
            }else{
                echo "100014";
            }

           


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
        // echo "11111";
      }else{
          echo "100111";
      }
    
}

function genarateToken($len = 32){
    return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }
?>