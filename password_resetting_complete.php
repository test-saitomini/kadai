<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');//日本時間へ変更（20210622）
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
    $pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");
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
        <title>TORカレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css" href="regist.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    </head>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
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
            <form action="top.php" >
                    <input type="submit" class="submit" value="トップページへ戻る">
                </form>
            <form action="login.php">
                <input type="submit" class="submit" value="ログイン画面へ戻る">
            </form>
        </div>
        </div>
    <footer>
            Copyright D.I.Works| D.I.blog is the one which provides Ato Z about programming
        </footer>
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>