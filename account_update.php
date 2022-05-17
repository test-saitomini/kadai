<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

session_start();

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    }else{
    $login_account = "0";
    $login_mail= NULL;
}

$id = $_POST['id'];

$pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");
            
$stmt = $pdo -> query('select * from account where id = '.$id);
$update = $stmt->fetch();

?>