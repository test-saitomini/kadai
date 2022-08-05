<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

session_start();

$delete_error_flag = 0;
$delete_error_message = 'カレンダーから予定を削除する日を選択してください。';

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    }else{
    $login_account = "0";
    $login_mail= NULL;
}

try{
    $pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;charset=utf8","b51f5ef5ea5d11","5edf58c2");
}catch(PDOException $Exception){
    $delete_error_message = $Exception->getMessage();
    $delete_error_flag = 1;
}

if($_POST != NULL){
    $id = $_POST['id'];
    $yotei_delete_flg = $_POST['yotei_delete_flg'];
    
    try{
        if($delete_error_flag == 0){
        $stmt = $pdo->query("UPDATE schedule SET yotei_delete_flg = $yotei_delete_flg where id = $id");
        }
    }catch(PDOException $Exception){
        $delete_error_message = $Exception->getMessage();
        $delete_error_flag = 1;
    }
}else{
    $delete_error_flag = 1;
}


?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TORカレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        
        <?php elseif($login_account == 1) : ?>
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
        <main>
            <div class = "main-container">
                <div class="back-top">
                    <?php if($delete_error_flag == 1){
                        echo '<h7>エラーが発生したため予定の削除が登録できません。<br>
                        '.$delete_error_message.'</h7>';
                    }else{
                        echo '<h4>予定の削除が完了しました。</h4>';
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
        <script type="text/javascript" src="regist_check_schedule.js"></script>
    </body>
</html>