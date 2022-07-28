<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>TORカレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
    </head>
    
    <body>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href="http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
            </ul>
        </header>
        <div class = "main-container">
        <h1>
            <font size='5'>ログアウトしました</font>
        </h1>
        <p><a href='login.php'>ログインページに戻る</a></p>
        </div>
        <footer>
            Copyright D.I.Works| portfolio_TDR-calendar
        </footer>
    </body>
</html>