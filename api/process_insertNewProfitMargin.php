<?php

include'connect.php';

  $network = $_POST["network"];
  $serviceType = $_POST["serviceType"];
  $profit = $_POST["profit"];

  session_start();
  $email = $_SESSION["email"];

  $sql = "INSERT INTO profits (network,serviceType,profit)
  VALUES ('$network','$serviceType','$profit')";
  if(verifyAdmin($conn,$email) == 1){
  if ($conn->query($sql) === TRUE) {
      echo "11111";
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