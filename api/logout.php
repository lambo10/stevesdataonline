<?php
session_start();

session_unset();

session_destroy();
setcookie("Uem", "", time() + (86400 * 30 * 6), "/");
setcookie("Upw", "", time() + (86400 * 30 * 6), "/");

header("location: ../index.php");	

?>