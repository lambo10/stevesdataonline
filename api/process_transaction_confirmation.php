<?php

include'connect.php';

  $id = $_GET["id"];

  $updateHandle = "UPDATE data_airtime_purchase_bucket SET status='1' WHERE id='$id'";
  if ($conn->query($updateHandle) === TRUE) {
      echo '{results:[{"status":"successful"}]}';
  }else{
      echo "100112";
  }


?>