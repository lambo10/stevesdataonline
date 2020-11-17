<?php

include'connect.php';

  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $password = $_POST["password"];
  $whoReferred_id = $_POST["whoReferred_id"];
  $gender = $_POST["gender"];
  $state = $_POST["state"];
  
if(scrutinize($email)){
    if(scrutinize($password)){
        
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

if($exisit==0){
    $token = genarateToken(5);
    $apiKey = genarateToken(12);
$sql = "INSERT INTO users (name,email,phone,password,whoReferredID,referralID,gender,state,apiKey)
VALUES ('$name','$email','$phone','$password','$whoReferred_id','$token','$gender','$state','$apiKey')";

if ($conn->query($sql) === TRUE) {
session_start();
$_SESSION["email"] = $email;
$_SESSION["name"] = $name;
$_SESSION["refID"] = $token;
setcookie("Uem", $email, time() + (86400 * 30 * 6), "/");
setcookie("Upw", $password, time() + (86400 * 30 * 6), "/");
echo '11111';
} else {
    echo "100111";
}

}else{
echo "100113";
}
    }else{
        echo "100114";  
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
?>