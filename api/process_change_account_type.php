<?php

include'connect.php';

  $accType = $_POST["accType"];
  session_start();
  $email = $_SESSION["email"];

  $handle2 = "SELECT gender,state FROM users WHERE email='$email'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            if(strcmp($gender,"-Gender-") == 0){
                $gender = $row["gender"];
            }
            if(strcmp($state,"-State-") == 0){
                $state = $row["state"];
            }
            $updateHandle = "UPDATE users SET accType='$accType' WHERE email='$email'";
                    if ($conn->query($updateHandle) === TRUE) {
                        echo "11111";
                    }else{
                        echo "100112";
                    }
        }
    }else{
        echo "100111";
    }


?>