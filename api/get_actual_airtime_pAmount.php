<?php
include'connect.php';

$amount = $_GET["amount"];
$network = $_GET["network"];

session_start();
$email = $_SESSION["email"];

$handle2 = "SELECT cost  FROM services WHERE network='$network' AND serviceType='AIRTIME' LIMIT 1";
$result2 = $conn->query($handle2);
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        $cost = $row["cost"];
        $profit_margin = getProfitMargin($conn,'AIRTIME',$network);
        $calculatedCost = (float)$amount + (float)$profit_margin;
        $final_calAmount = $calculatedCost - ((get_user_accType($conn,$email)/100)*$calculatedCost);
        echo $final_calAmount;
    }
}else{
    echo 'Erro';
}

function getProfitMargin($conn,$serviceType,$networkProvider){
    $handle2 = "SELECT profit FROM profits WHERE serviceType='$serviceType' AND network='$networkProvider'";
$result2 = $conn->query($handle2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $profit = $row["profit"];
        return $profit;
    }
    
}else{
    return -1;
}
}

function get_user_accType($conn,$email){
    $handle2 = "SELECT accType FROM users WHERE email='$email'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
          $accType = $row["accType"];
          $handle = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='$accType' LIMIT 1";
          $result = $conn->query($handle);
          if ($result->num_rows > 0) {
              while($row2 = $result->fetch_assoc()) {
                $output = $row2["instruction_or_data"];
                return (float)$output;
              }
          }else{
            return -1;
          }
        }
      }else{
        $accType = "Enduser";
        $handle = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='$accType' LIMIT 1";
        $result = $conn->query($handle);
        if ($result->num_rows > 0) {
            while($row2 = $result->fetch_assoc()) {
              $output = $row2["instruction_or_data"];
              return (float)$output;
            }
        }else{
          return -1;
        }
      }
  }
?>