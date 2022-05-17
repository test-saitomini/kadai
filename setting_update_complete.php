<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');//日本時間へ変更（20210622）
$update_error_flag = 0;
$update_error_message = 'カレンダーから予定を編集する日を選択してください。';

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
    $update_error_message = $Exception->getMessage();
    $update_error_flag = 1;
}

if($_POST != NULL){
    $id = $_POST['id'];
    $day_kaishi = $_POST['day_kaishi'];
    $day_owari = $_POST['day_owari'];
    $midashi = $_POST['midashi'];
    $naiyou = $_POST['naiyou'];
    
    try{
        if($update_error_flag == 0){
        $stmt = $pdo -> prepare("UPDATE setting SET day_kaishi =?,day_owari =?,midashi=?,naiyou=? where id = ".$id);
        $stmt->execute(array($day_kaishi,$day_owari,$midashi,$naiyou));
        }
    }catch(PDOException $Exception){
        $update_error_message = $Exception->getMessage();
        $update_error_flag = 1;
    }
}else{
    $update_error_flag = 1;
}

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>予定入力完了画面</title>
        <link rel="stylesheet"type="text/css" href="regist.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    </head>
    <?php if($login_account == 1) : ?>
    <?php if($login_authority == 1) : ?>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/mypage.php">マイページ</a></li>
                <li><a href = "http://localhost/kadai/setting.php">設定</a></li>
                <li><a href = "http://localhost/kadai/logout.php">ログアウト</a></li>
            </ul>
        </header>
    <body>
        <div class = "main-container">
        <div class="back-top">
            <?php if($update_error_flag == 1){
                echo '<h7>エラーが発生したため予定の編集が登録できません。<br>
            '.$update_error_message.'</h7>';
            }else{
                echo '<h4>予定の編集が完了しました。</h4>';
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
        <?php else : ?>
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
                <h8>※この画面は操作できません。</h8>
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
            <br>
        </main>
        <?php endif; ?>
    <?php elseif($login_account == 0) : ?>
    <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
            </ul>
    </header>
    <main>
        <div class="update_error_messge">
            <h8>※アカウントログインしてから操作を行ってください。</h8>
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
        <div class="update_error_messge">
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