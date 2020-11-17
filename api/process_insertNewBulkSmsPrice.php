<?php

include'connect.php';

  $fromIn = $_POST["fromIn"];
  $toIn = $_POST["toIn"];
  $price_per_unitIn = $_POST["price_per_unitIn"];

  $sql = "INSERT INTO bulkSmsPricing (fromIn,toIn,price_per_unitIn)
  VALUES ('$fromIn','$toIn','$price_per_unitIn')";
  
  if ($conn->query($sql) === TRUE) {
      echo "11111";
    }else{
        echo "100111";
    }
?>