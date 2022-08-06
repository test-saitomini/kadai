<?php

$update_error_flag = 0;
$update_error_message = 'エラーのためパスワード再設定できませんでした。';

session_start();

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    $login_id = $_SESSION["id"];
    }else{
    $login_account = "0";
    $login_mail= NULL;
}

try{
    $pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;charset=utf8","b51f5ef5ea5d11","5edf58c2");
}catch(PDOException $Exception){
    $update_error_message = $Exception->getMessage();
    $update_error_flag = 1;
}

if($_POST != NULL){
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $id = $_POST['id'];
    
    try{
        if($update_error_flag == 0){
        $stmt = $pdo -> prepare("UPDATE account SET password = ? where id = ".$id);
        $stmt->execute(array($password));
        }
    }catch(PDOException $Exception){
        $update_error_message = $Exception->getMessage();
        $update_error_flag = 1;
    }
}else{
    $update_error_flag = 1;
}

//セッションの中身を消す
$_SESSION = array();
//セッションクリア
session_destroy();

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>趣味カレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css" href="regist.css">
    </head>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li> </li>
            </ul>
        </header>
    <body>
        <div class = "main-container">
            <h1>パスワード再設定完了</h1>
        <div class="back-top">
            <?php if($update_error_flag == 1){
                echo '<h7>エラーが発生したためパスワード再設定ができません。<br>
            '.$update_error_message.'</h7>';
            }else{
                echo '<h4>パスワード再設定が完了しました。</h4>';
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
    <footer>
            Copyright D.I.Works| portfolio_趣味-calendar_saito
        </footer>
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>