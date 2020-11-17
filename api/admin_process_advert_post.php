<?php

include'connect.php';

  $title = $_POST["title"];
  $ad_link = $_POST["ad_link"];

  session_start();
  $email = $_SESSION["email"];
  

if(verifyAdmin($conn,$email) == 1){
    $sql = "INSERT INTO adverts (title,ad_link)
VALUES ('$title','$ad_link')";

if ($conn->query($sql) === TRUE) {
    $lastID = $conn -> insert_id;
    echo $lastID;
} else {
    echo "100112";
}
}else{
    echo "100111";
}

function verifyAdmin($conn,$email){
    $handle2 = "SELECT email  FROM admin_users WHERE email='$email'";
    $result2 = $conn->query($handle2);
    $exisit=0;
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
         $big4 = $row["email"];
         
        if($email==$big4){
        $exisit = $exisit+1;
        }
        }
    }
    return $exisit;
}


?>