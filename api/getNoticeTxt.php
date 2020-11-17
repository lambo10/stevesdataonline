<?php

include'connect.php';

$handle2 = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='notice'";
$result2 = $conn->query($handle2);
$dbData = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        echo $row["instruction_or_data"];
    }
}

?>