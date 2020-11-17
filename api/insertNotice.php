<?php

include'connect.php';

  $notice = $_POST["notice"];

  $handle2 = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='notice'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            
            $updateHandle = "UPDATE site_operation_var SET instruction_or_data='$notice' WHERE operation_name='notice'";
                    if ($conn->query($updateHandle) === TRUE) {
                        
                        echo "11111";
                    }else{
                        echo "100112";
                    }
        }
    }else{
        $sql = "INSERT INTO site_operation_var (instruction_or_data,operation_name)
        VALUES ('$notice','notice')";
        
        if ($conn->query($sql) === TRUE) {
            echo "11111";
          }else{
              echo "100111";
          }
    }


?>