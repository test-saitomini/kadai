<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

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

$pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");

$stmt = $pdo -> prepare('select * from account where mail = ?');
$stmt ->execute(array($login_mail));

$restting = $stmt -> fetch();

?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>TORカレンダー_ポートフォリオ</title>
    <link rel="stylesheet"type="text/css" href="regist.css">
</head>
    
    <body>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href="http://localhost/kadai/regist.php">会員登録</a></li>
                <li> </li>
            </ul>
        </header>
        
        <main>
            <div class = "main-container">
            <h1>パスワード再設定</h1>
                新しいパスワードを設定してください。
            <div class="form">
            <form id="kakuninForm" name="kakuninForm" action="password_resetting_complete.php" method="POST">
                <table class="box">
                    <tr>
                        <td><label>パスワード</label><h7>*</h7></td>
                        <td><input type="password"class="text" size="45"name="password"id="password"value="<?php if(    !empty($_POST['password']) ){ echo $_POST['password']; } ?>"><br>
                            <span id = 'password_error' class="error_m"></span></td>
                    </tr>
                    <tr>
                        <td><label>もう一度パスワードを入力してください。</label><h7>*</h7></td>
                        <td><input type="password"class="text" size="45"name="password_re"id="password_re"value="<?php if(  !empty($_POST['password_re']) ){ echo $_POST['password_re']; } ?>"><br>
                        <span id = 'password_re_error' class="error_m"></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" id="kakunin" name="kakunin" value="確認する">
                            <input type="hidden" name = "id" id="id" value="<?php echo $restting['id'];?>"></td>
                    </tr>
                </table>
                </form>
                </div>
            </div>
        </main>
          
        <footer>
            Copyright D.I.Works| portfolio_TDR-calendar
        </footer>
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>