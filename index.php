<?php
session_start();
$email = $_SESSION["email"];
$name = $_SESSION["name"];
$refID = $_SESSION["refID"];
$orderID = $_SESSION["orderID"];
$page = $_GET["page"];
if(empty($page)){
    header("location: mainIndex.php?email=".$email."&name=".$name."&refID=".$refID);
}else{
    header("location: ".$page."?email=".$email."&name=".$name."&refID=".$refID);
}
?>