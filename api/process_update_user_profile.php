<?php

include'connect.php';

  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"];
  $state = $_POST["state"];
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
            $updateHandle = "UPDATE users SET name='$name',phone='$phone',gender='$gender',state='$state' WHERE email='$email'";
                    if ($conn->query($updateHandle) === TRUE) {
                        $_SESSION["name"] = $name;
                        echo "11111";
                    }else{
                        echo "100112";
                    }
        }
    }else{
        echo "100111";
    }


?>