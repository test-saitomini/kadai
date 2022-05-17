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
    <title>パスワード再設定画面</title>
    <link rel="stylesheet"type="text/css" href="regist.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
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
            <h1>パスワード再設定確認画面</h1>
                新しいパスワードを設定してください。
            <div class="form">
            <form id="kakuninForm" name="kakuninForm" action="password_resetting_complete.php" method="POST">
                <div class="textarea">
                        <label>パスワード</label><h7>*</h7>
                        <input type="password"class="text" size="10"name="password"id="password"value="<?php if( !empty($_POST['password']) ){ echo $_POST['password']; } ?>"><br>
                        <span id = 'password_error' class="error_m"></span><br>
                    </div>
                <input type="submit" id="kakunin" name="kakunin" value="確認する">
                <input type="hidden" name = "id" id="id" value="<?php echo $restting['id'];?>">
            </form>
            </div>
            </div>
        </main>
        
        <footer>
            Copyright D.I.Works| D.I.blog is the one which provides Ato Z about programming
        </footer>
        <script type="text/javascript" src="regist.js"></script>
    </body>
</html>