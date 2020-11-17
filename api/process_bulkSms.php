<?php
include 'connect.php';

$numbers = $_POST["numbers"];
$message = $_POST["message"];
$senderid = $_POST["senderid"];
$token = 'NnFGCnv2VBk71r8VncDxcvXmfWijPAgi0Hsq1pY4sSepfUzUe8HDZZ53IrImOItZ67anZyj7JujyZabBRErjj7bfNFNzBluhR7sn';
$baseurl = 'https://smartsmssolutions.com/api/json.php?';

session_start();
$email = $_SESSION["email"];
$name = $_SESSION["name"];
$refID = $_SESSION["refID"];
$orderID = $_SESSION["orderID"];
$numberArray = explode(",",$message);
$routing = count($numberArray);

$handle2 = "SELECT * FROM bulkSmsPricing WHERE msgAmount1 >= $routing AND msgAmount2 <= $routing";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {

      $payment_per_number = $row["payment_per_number"];
      $paymet_amount = (float)$payment_per_number * $routing;
      if(deduct_amout_from_user_bal($conn,$email,$paymet_amount)){
        sendMsg($conn,$email,$paymet_amount,$refID,$senderid,$numbers,$message,$routing,$token,$baseurl);
      }else{
        echo "100132";
      }

    }
}

function sendMsg($conn,$email,$cost,$refID,$senderid,$numbers,$message,$routing,$token,$baseurl){
  $sms_array = array 
  (
  'sender' => $senderid,
  'to' => $numbers,
  'message' => $message,
  'type' => '0', 
  'routing' => $routing,
  'token' => $token
);

$params = http_build_query($sms_array);
$ch = curl_init(); 

curl_setopt($ch, CURLOPT_URL,$baseurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 

$output=curl_exec($ch);

curl_close($ch);

$response = json_decode($output);
$response_code = $response->code;

if ($response_code == '1000') {
  insertTransaction($conn,$email,$cost,"BULKSMS",$refID,"",$numbers,$response_code);
}
else
{
    echo "100023";
}
}

function deduct_amout_from_user_bal($conn,$email,$cost){
  $handle2 = "SELECT AccBalance FROM users WHERE email='$email'";
  $result2 = $conn->query($handle2);
  if ($result2->num_rows > 0) {
      while($row = $result2->fetch_assoc()) {
          $accBalance = $row["AccBalance"];
          $newBalance = (float)$accBalance - $cost;
          if($newBalance > 0){
            update_acc_bal($conn,$newBalance,$email);
            return true;
          }else{
            return false;
          }
      }
  }else{
    return false;
  }
}


function insertTransaction($conn,$userEmail,$cost,$type,$refID,$network,$phoneNo,$output){
    
    $sql = "INSERT INTO transactions (userEmail,cost,type,refID,network,meter_pnone_iuc_No,output)
VALUES ('$userEmail','$cost','$type','$refID','$network','$phoneNo','$output')";

if ($conn->query($sql) === TRUE) {
 }

}

?>