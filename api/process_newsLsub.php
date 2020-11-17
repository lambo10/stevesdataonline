<?php

include'connect.php';
  $email = $_POST["email"];

  $handle2 = "SELECT email  FROM newsletterEmail WHERE email='$email'";
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
  $sql = "INSERT INTO newsletterEmail (email)
  VALUES ('$email')";
  if ($conn->query($sql) === TRUE) {
      echo '11111';
  }else{
      echo '100111';
  }
}else{
  echo '100112';
}
  ?>