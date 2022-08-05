<?php
$error_flag = 0;
$error_message = '予定入力画面からやり直してください。';

session_start();

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    }else{
    $login_account = "0";
}

try{
    $pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;charset=utf8","b51f5ef5ea5d11","5edf58c2");
}catch(PDOException $Exception){
    $error_message = $Exception->getMessage();
    $error_flag = 1;
}

if($_POST != NULL){
    try{
        if($error_flag == 0){
        $pdo -> exec("insert into schedule(day_kaishi,day_owari,yotei,naiyou,url,mail,yotei_delete_flg)values('".$_POST['day_kaishi']."','".$_POST['day_owari']."','".$_POST['yotei']."','".$_POST['naiyou']."','".$_POST['url']."','".$login_mail."','".$_POST['yotei_delete_flg']."');");
        }
    }catch(PDOException $Exception){
        $error_message = $Exception->getMessage();
        $error_flag = 1;
    }
}else{
    $error_flag = 1;
}

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TORカレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css" href="regist.css">
    </head>
    <?php if($login_account == 1) : ?>
    <?php if($login_authority == 1) : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/setting.php">設定</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <?php else : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <?php endif; ?>
    <body>
        <div class = "main-container">
        <div class="back-top">
            <?php if($error_flag == 1){
                echo '<h7>エラーが発生したため予定の入力が登録できません。<br>
            '.$error_message.'</h7>';
            }else{
                echo '<h4>予定の入力が完了しました。</h4>';
            };?>
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
        </div>
    </body>
    <?php elseif($login_account == 0) : ?>
    <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/login.php">ログイン</a></li>
            </ul>
    </header>
    <main>
        <div class="error_messge">
            <h8>※アカウントをログインしてから行ってください。</h8>
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
            <h8>※何らかのエラーが発生しました。<br>
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
    
</html>