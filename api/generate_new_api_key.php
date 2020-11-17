<?php

include'connect.php';

  session_start();
  $email = $_SESSION["email"];

  $apiKey = genarateToken(12);
  $updateHandle = "UPDATE users SET apiKey='$apiKey' WHERE email='$email'";
  if ($conn->query($updateHandle) === TRUE) {
      echo "11111";
  }else{
      echo "100112";
  }

  function genarateToken($len = 32){
    return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }

?>