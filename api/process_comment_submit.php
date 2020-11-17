<?php

include'connect.php';

  $email = $_POST["email"];
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $postID = $_POST["postID"];
  

    $sql = "INSERT INTO comments (email,name,comment,postID)
VALUES ('$email','$name','$comment','$postID')";

if ($conn->query($sql) === TRUE) {
    echo "11111";
} else {
    echo "100112";
}


?>