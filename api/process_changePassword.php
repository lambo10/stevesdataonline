<?php

include'connect.php';

  $password = $_POST["password"];
  $new_password = $_POST["new_password"];

  session_start();
  $email = $_SESSION["email"];

  $updateHandle = "UPDATE users SET password='$new_password' WHERE email='$email' AND password='$password'";
  if ($conn->query($updateHandle) === TRUE) {
      $_SESSION["name"] = $name;
      echo "11111";
  }else{
      echo "100112";
  }


?>