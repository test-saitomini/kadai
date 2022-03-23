<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ログアウト</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
    </head>
    
    <body>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href="http://localhost/kadai/regist.php">会員登録</a></li>
            </ul>
        </header>
        <h1>
            <font size='5'>ログアウトしました</font>
        </h1>
        <p><a href='login.php'>ログインページに戻る</a></p>
        <footer>
            portfolio_
        </footer>
    </body>
</html>