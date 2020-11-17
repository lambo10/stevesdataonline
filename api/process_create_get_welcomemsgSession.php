<?php

  session_start();
  if(isset($_COOKIE["visted_site"])) {
  $can_dispWmsg = $_SESSION["can_dispWmsg"];
  if(strcmp($can_dispWmsg,'1') == 0){
    $_SESSION["can_dispWmsg"] = 2;
    $can_dispWmsg = $_SESSION["can_dispWmsg"];
    echo $can_dispWmsg."_0";
  }else if(strcmp($can_dispWmsg,'') == 0){
    $_SESSION["can_dispWmsg"] = 1;
    $can_dispWmsg = $_SESSION["can_dispWmsg"];
    echo $can_dispWmsg."_0";
  }else{
    $can_dispWmsg = $_SESSION["can_dispWmsg"];
    echo $can_dispWmsg."_0";
  }
}else{
    setcookie("visted_site", "1", time() + (86400 * 30 * 6), "/");
    $can_dispWmsg = $_SESSION["can_dispWmsg"];
  if(strcmp($can_dispWmsg,'1') == 0){
    $_SESSION["can_dispWmsg"] = 2;
    $can_dispWmsg = $_SESSION["can_dispWmsg"];
    echo $can_dispWmsg."_1";
  }else if(strcmp($can_dispWmsg,'') == 0){
    $_SESSION["can_dispWmsg"] = 1;
    $can_dispWmsg = $_SESSION["can_dispWmsg"];
    echo $can_dispWmsg."_1";
  }else{
    $can_dispWmsg = $_SESSION["can_dispWmsg"];
    echo $can_dispWmsg."_1";
  }
}

?>