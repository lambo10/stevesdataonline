<?php

$email = $_GET["email"];
$token = $_GET["token"];

$to = $email;

    ini_set( 'display_errors', 1 );
 error_reporting( E_ALL );
 $from = "invest@camdencapitals.com";
 $subject = "Camden Capitals email confirmation";
 $message = " <div><img src='https://camdencapital.clientaccessportal.com/Theme/Logo' style='width:450px; height:100px'></div> <br>";
 $message .= " <div style='padding-left:40px; font-size:25px'>Hello,</div> <br>";
 $message .= " <div style='padding-left:40px; font-size:25px'>Thank you for joining Camdencapitals. Use the 7 digit code to verify your email address.</div> <br><br>";
 $message .= " <div style='font-size:45px; padding-left:40px;'><b>".$token."</b></div> <br><br>";
  $message .= " <div style='padding-left:40px;'><b>Tip of the day:</b> Add our email to your contacts to make sure these emails never get lost </div> <br>";
  $message .= " <div style='font-size:22px; padding-left:40px'>Thanks,</div>";
$message .= " <div style='font-size:22px; padding-left:40px'>The camdencapitals Team</div> <br>";

         
         $headers = "From: ". $from."\r\n";
        $headers .= "Reply-To: ". $from."\r\n";
        $headers .= "Return-Path: ". $from."\r\n";
        $headers .= "CC: ". $to."\r\n";
        $headers .= "BCC: ". $to."m\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

 mail($to,$subject,$message, $header);

 echo ''

?>