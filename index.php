<?php
$pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;charset=utf8","b51f5ef5ea5d11","5edf58c2");

echo "データ接続成功<br>";

$schedule = $pdo -> query('select * from setting where set_delete_flg = 0');

echo "テーブルセレクト成功<br>";


$yotei = $pdo -> prepare('select * from schedule where mail = "test@gmail.com"');

echo "テーブルセレクト2成功<br>";
//phpinfo();

//header('Location: ./top.php');
//exit();
?>