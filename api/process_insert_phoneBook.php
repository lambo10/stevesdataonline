<?php

include'connect.php';

  $bookname = $_POST["bookname"];
  $recipients = $_POST["recipients"];

  $sql = "INSERT INTO phonebook (bookname,recipients)
  VALUES ('$bookname','$recipients')";
  
  if ($conn->query($sql) === TRUE) {
      echo "11111";
    }else{
        echo "100111";
    }
?>