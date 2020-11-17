<html>
    <script>
        alert("<?php
session_start();
$email = $_SESSION["email"];
echo $email;
?>");
    </script>
</html>