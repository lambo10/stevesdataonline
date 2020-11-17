<?php

include'connect.php';

$id = $_GET["id"];
session_start();
$email = $_SESSION["email"];

if(verifyAdmin($conn,$email) == 1){
$sql = "DELETE FROM products_posts WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "11111";
        unlink("uploads/product_post/".$id."/post_pic.jpg");
      } else {
        echo "100111";
      }
}else{
    echo "100112";
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