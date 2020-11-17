<?php

include'connect.php';

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  
if(scrutinize($email)){
    if(scrutinize($password)){
        
$handle2 = "SELECT email  FROM admin_users WHERE email='$email'";
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
$sql = "INSERT INTO admin_users (name,email,password)
VALUES ('$name','$email','$password')";

if ($conn->query($sql) === TRUE) {
session_start();
$_SESSION["email"] = $email;
$_SESSION["name"] = $name;
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