<?php

include'connect.php';

  $network = $_POST["network"];
  $cost = $_POST["cost"];
  $slashPrice = $_POST["slashPrice"];
  $type = $_POST["type"];
  $validity = $_POST["validity"];
  $extAPI_ID = $_POST["extAPI_ID"];
  $serviceType = $_POST["serviceType"];

  session_start();
  $email = $_SESSION["email"];

  $sql = "INSERT INTO services (network,cost,type,validity,extAPI_ID,serviceType,slashPrice)
  VALUES ('$network','$cost','$type','$validity','$extAPI_ID','$serviceType','$slashPrice')";
  if(verifyAdmin($conn,$email) == 1){
  if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
    }else{
        echo "100111";
    }
  }else{
    echo "100112";
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