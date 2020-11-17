<?php
session_start();
$email = $_SESSION["email"];
$name = $_SESSION["name"];
$refID = $_SESSION["refID"];
$orderID = $_SESSION["orderID"];
echo '{"email":"'.$email.'","name":"'.$name.'","refID":"'.$refID.'","orderID":"'.$orderID.'"}';
?>