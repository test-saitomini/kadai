<?php

session_start();

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    }else{
    $login_account = "0";
}
?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TORカレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
    </head>
    <body>
        
        <?php if($login_account == 0) : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/login.php">ログイン</a></li>
            </ul>
        </header>
        <div class = "main-container">
        <?php if($_POST != NULL) : ?>
        <h2>アカウント登録内容の確認</h2>
        <p>アカウント登録はこちらでよろしいでしょうか？
        <br>よろしければ「登録する」ボタンを押してください。
        </p>
        <div class = kakunin>
            <table class="box2">
                <tr>
                    <td>名前</td>
                    <td><?php echo $_POST['name'];?></td>
                    </tr>
                <tr>
                    <td>メールアドレス</td>
                    <td><?php echo $_POST['mail'];?></td>
                </tr>
                <tr>
                    <td>パスワード</td>
                    <td><?php
                        $password = $_POST['password'];
                        for($i=0;$i< mb_strlen($password);$i++){
                            echo '●';}?></td>
                </tr>
                </table>
        <table class="button">
            <tr>
                <td>
                    <input type="submit" onclick=history.back() value="戻って修正する">
                </td>
                <td>
                    <form action="regist_complete.php" method="post">
                        <input type="submit" name="btn_submit" value="登録する">
                        <input type="hidden" value="<?php echo $_POST['name'];?>" name="name">
                        <input type="hidden" value="<?php echo $_POST['mail'];?>" name="mail">
                        <input type="hidden" value="<?php echo $_POST['password'];?>" name="password">
                        <input type="hidden" value="0" name="authority">
                        <input type="hidden" value="0" name="account_delete_flg">
                    </form>
                </td>
            </tr>
        </table>
        </div>
        </div>
        <?php else : ?>
            <div class="error_messge">
                <h8>※新規会員登録画面からアカウント登録をしてください。</h8>
                <form action="regist.php" >
                    <input type="submit" class="submit" value="アカウント登録画面へ進む">
                </form>
            </div>
        <?php endif; ?>
        
        <?php elseif($login_account == 1) : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <main>
            <div class="error_messge">
                <h8>※すでにアカウント登録されています。</h8>
                <table class="button">
                        <tr>
                            <td>
                                <form action="top.php" >
                                    <input type="submit" class="submit" value="トップページへ戻る">
                                </form>
                            </td>
                            <td>
                                <form action="login.php">
                                    <input type="submit" class="submit" value="ログイン画面へ戻る">
                                </form>
                            </td>
                        </tr>
                    </table>
            </div>
        </main>
        <?php else : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/login.php">ログイン</a></li>
            </ul>
        </header>
        <main>
            <div class="error_messge">
                <h8>※何らかのエラーが発生しています。<br>
                最初からやり直してください。</h8>
                <table class="button">
                    <tr>
                        <td>
                            <form action="top.php" >
                                <input type="submit" class="submit" value="トップページへ戻る">
                            </form>
                        </td>
                        <td>
                            <form action="login.php">
                                <input type="submit" class="submit" value="ログイン画面へ戻る">
                            </form>
                        </td>
                        <td>
                            <form action="regist.php">
                                <input type="submit" class="submit" value="会員登録画面へ戻る">
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </main>
        <?php endif; ?>
    
    <footer>
            Copyright D.I.Works| portfolio_趣味-calendar_saito
    </footer>
    </body>
        </html>