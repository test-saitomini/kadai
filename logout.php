<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>趣味カレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
    </head>
    
    <body>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href="https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/login.php">ログイン</a></li>
            </ul>
        </header>
        <div class = "main-container">
        <h1>
            <font size='5'>ログアウトしました</font>
        </h1>
        <p><a href='login.php'>ログインページに戻る</a></p>
        </div>
        <footer>
            Copyright D.I.Works| portfolio_趣味-calendar_saito
        </footer>
    </body>
</html>