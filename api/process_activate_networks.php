<?php

include'connect.php';

  $networks = $_POST["networks"];

  session_start();
  $email = $_SESSION["email"];
  if(verifyAdmin($conn,$email) == 1){
  $jsonNetworks = json_decode($networks,true);

  $handle2 = "SELECT name FROM networks";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $name = $row["name"];
            update_active_services($conn,$name,'0');
        }
    }

    for($i=0; $i < count($jsonNetworks); $i++){
        if(check_network_exsistence($conn,$jsonNetworks[$i]) == false){
            if(empty($jsonNetworks[$i])){}else{
                insertNewNetwork($conn,$jsonNetworks[$i]);
            }
        }else{
            update_active_services($conn,$jsonNetworks[$i],'1');
        }
    }
    echo "11111";
}else{
    echo "100112";
  }
  
  

 

  function update_active_services($conn,$name,$value){
  $updateHandle = "UPDATE networks SET status=$value WHERE name='$name'";
                    if ($conn->query($updateHandle) === TRUE) {
                    }
  }
  function insertNewNetwork($conn,$name){
    $sql = "INSERT INTO networks (name,status)
    VALUES ('$name','1')";
    
    if ($conn->query($sql) === TRUE) {
        
      }else{
          echo "100111";
      }
  }
  function check_network_exsistence($conn,$name){
      $output = false;
    $handle2 = "SELECT name FROM networks WHERE name='$name'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $output = true;
        }
    }
    return $output;
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