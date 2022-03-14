<?php
mb_language('ja');
mb_internal_encoding("UTF-8");

session_start();

if($_SESSION != NULL){
    $login_id = $_SESSION["id"];
}else{
    $login_id = "NULL";
}

?>

