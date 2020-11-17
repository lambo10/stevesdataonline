<?php

include'connect.php';
$email = $_POST["email"];
  
if(scrutinize($email)){
        $name = "";
$handle2 = "SELECT email  FROM users WHERE email='$email'";
$result2 = $conn->query($handle2);
$exisit=0;
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        $big4 = $row["email"];
        if($email==$big4){
        $exisit = $exisit+1;
        }
	}
}

if($exisit == 1){
    $token = genarateToken(5);
    $sql = "INSERT INTO reset_key (email,code,expirey_date)
    VALUES ('$email','$token',NOW() + INTERVAL 4 HOUR)";
    
    if ($conn->query($sql) === TRUE) {
        sendComfirmationEmail($email,$token);
        echo "11111";
    }
    
}else{
    echo "100113";
}
   
}else{
    echo "100115";
}

function genarateToken($len = 32){
    return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }

function scrutinize($data){
    $has_semicolon = stripos($data, '"') !== false;
    $has_colon = stripos($data, "'") !== false;
    $has_equal_to = stripos($data, '=') !== false;
    $result = false;
    if (!$has_semicolon){
        if (!$has_equal_to){
            if (!$has_colon){
            $result = true;
            }
        }
    }
    return $result;
}

function sendComfirmationEmail($to,$token){
    ini_set( 'display_errors', 1 );
 error_reporting( E_ALL );
 $from = "support@stevesdataonline.com";
 $subject = "Reset password stevesdataonline";
 $message = " <div><img src='https://stevesdataonline.com/images/logo/logoBlue.png' style='width:200px; height:70px'></div> <br>";
 $message .= " <div style='padding-left:40px; font-size:25px'>Hello,</div> <br>";
 $message .= " <div style='padding-left:40px; font-size:25px'>Use the 5 digit code to reset your password.</div> <br><br>";
 $message .= " <div style='font-size:45px; padding-left:40px;'><b>".$token."</b></div> <br><br>";
  $message .= " <div style='padding-left:40px;'>This code will expire in 4 hours </div> <br>";
$message .= " <div style='font-size:22px; padding-left:40px'>support@stevesdataonline.com</div> <br>";

         $header = "From:". $from." \r\n";
         $header .= "Cc:". $from." \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
 mail($to,$subject,$message, $header);
 return true;
}
?>