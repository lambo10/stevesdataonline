<?php

include'connect.php';

  $title = $_POST["title"];
  $author = $_POST["author"];
  $body = $_POST["body"];

  session_start();
  $email = $_SESSION["email"];
  

    $sql = "INSERT INTO blog_posts (title,author,body)
VALUES ('$title','$author','$body')";

if ($conn->query($sql) === TRUE) {
    $lastID = $conn -> insert_id;
    echo $lastID;
} else {
    echo "100112";
}


?>