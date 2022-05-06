<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');//日本時間へ変更（20210622）
$error_flag = 0;
$error_message = 'アカウント登録画面からアカウント登録をしてください。';

session_start();

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    }else{
    $login_account = "0";
}

try{
    $pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");
}catch(PDOException $Exception){
    $error_message = $Exception->getMessage();
    $error_flag = 1;
}

if($_POST != NULL){
    try{
        if($error_flag == 0){
        $pdo -> exec("insert into account(name,mail,password,authority)values('".$_POST['name']."','".$_POST['mail']."','".password_hash($_POST['password'],PASSWORD_DEFAULT)."','".$_POST['authority']."');");
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
        <title>アカウント登録完了画面</title>
        <link rel="stylesheet"type="text/css" href="regist.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    </head>
    <?php if($login_account == 0) : ?>
    <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
            </ul>
    </header>
    <body>
        <div class = "main-container">
        <div class="back-top">
            <?php if($error_flag == 1){
                echo '<h7>エラーが発生したためアカウント登録できません。<br>
            '.$error_message.'</h7>';
            }else{
                echo '<h4>登録完了しました。</h4>';
            };?>
            <form action="top.php" >
                    <input type="submit" class="submit" value="トップページへ戻る">
                </form>
            <form action="login.php">
                <input type="submit" class="submit" value="ログイン画面へ戻る">
            </form>
        </div>
        </div>
    </body>
    <?php elseif($login_account == 1) : ?>
    <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/mypage.php">マイページ</a></li>
                <li><a href = "http://localhost/kadai/logout.php">ログアウト</a></li>
            </ul>
    </header>
    <main>
        <div class="error_messge">
            <h8>※すでにアカウント登録されています。</h8>
            <form action="login.php" >
                <input type="submit" class="submit" value="ログイン画面へ戻る">
            </form>
            <form action="top.php" >
                <input type="submit" class="submit" value="トップページへ戻る">
            </form>
        </div>
    </main>
    <?php else : ?>
    <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
            </ul>
    </header>
    <main>
        <div class="error_messge">
            <h8>※何らかのエラーが発生しました。<br>
                最初からやり直してください。</h8>
            <form action="login.php">
                <input type="submit" class="submit" value="ログイン画面へ戻る">
            </form>
            <form action="regist.php">
                <input type="submit" class="submit" value="会員登録画面へ戻る">
            </form>
            <form action="top.php" >
                <input type="submit" class="submit" value="トップページへ戻る">
            </form>
        </div>
    </main>
    <?php endif; ?>
    <footer>
            Copyright D.I.Works| D.I.blog is the one which provides Ato Z about programming
    </footer>
    
</html>