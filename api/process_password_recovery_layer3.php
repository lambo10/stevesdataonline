<?php

include'connect.php';
$password = $_POST["password"];
$code = $_POST["code"];
  
if(scrutinize($email)){
        $name = "";
        $email = "";
$handle2 = "SELECT email  FROM reset_key WHERE code='$code'";
$result2 = $conn->query($handle2);
$exisit=0;
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $email = $row["email"];
        $exisit = $exisit+1;
	}
}

if($exisit == 1){
    $updateHandle = "UPDATE users SET password='$password' WHERE email='$email'";
    if ($conn->query($updateHandle) === TRUE) {
        
        echo "11111"; 
    } else {
    echo "100012";
    }
   
}else{
    echo "100113";
}
   
}else{
    echo "100115";
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