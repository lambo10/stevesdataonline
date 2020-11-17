<?php

include'connect.php';

  $operation_name = $_POST["operation_name"];
  $instruction_or_data = $_POST["instruction_or_data"];

  $handle2 = "SELECT operation_name FROM site_operation_var WHERE operation_name='$operation_name' LIMIT 1";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
          update_opVar($conn,$operation_name,$instruction_or_data);
        }
    }else{
      insert_new_opVar($conn,$operation_name,$instruction_or_data);
    }

function insert_new_opVar($conn,$operation_name,$instruction_or_data){
  $sql = "INSERT INTO site_operation_var (operation_name,instruction_or_data)
  VALUES ('$operation_name','$instruction_or_data')";
  
  if ($conn->query($sql) === TRUE) {
      echo "11111";
    }else{
        echo "100111";
    }
}
function update_opVar($conn,$operation_name,$instruction_or_data){
  $updateHandle = "UPDATE site_operation_var SET instruction_or_data='$instruction_or_data' WHERE operation_name='$operation_name'";
                    if ($conn->query($updateHandle) === TRUE) {
                      echo "11111";
                    }else{
                      echo "100111";
                    }
  }
?>