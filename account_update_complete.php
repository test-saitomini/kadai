<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$update_error_flag = 0;
$update_error_message = 'アカウント一覧画面から更新するデータを選択してください。';

session_start();
if($_SESSION != NULL){
    $login_authority = $_SESSION["authority"];
}else{
    $login_authority = "NULL";
}

if($_POST != NULL){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password_check = $_POST['password_check'];
    $password = $_POST['password'];
    $authority = $_POST['authority'];
    $account_delete_flag = $_POST['account_delete_flag'];
}else{
    $update_error_flag = 1;
}



try{
    $pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");
}catch(PDOException $Exception){
    $update_error_message = $Exception->getMessage();
    $update_error_flag = 1;
}

try{
    if($update_error_flag == 0){
        $password_update = "";
        if($password_check == 1){
            $password_update = "password = ?,";
        }
        $stmt = $pdo->prepare("UPDATE account SET name = ?,mail = ?,".$password_update."authority = ?,account_delete_flag = ?,update_time = ? where id = $id");
    }
}catch(PDOException $Exception){
    $update_error_message = $Exception->getMessage();
    $update_error_flag = 1;
}

try{
    if($update_error_flag == 0){
        $data = array($name,$mail);

        if($password_check == 1){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $data = array_merge($data,array($password));// 配列に追加したいけど、正しい書き方ではない
        }

        $data =  array_merge($data,array($$authority,
                      $delete_flag));// 更に追加してあげたいけど、、、

        $stmt->execute($data);
    }
}catch(PDOException $Exception){
    $update_error_message = $Exception->getMessage();
    $update_error_flag = 1;
}
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
        <?php else : ?>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/mypage.php">マイページ</a></li>
                <li><a href = "http://localhost/kadai/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <?php endif; ?>
    <body>
        <div class = "main-container">
        <div class="back-top">
            <?php if($update_error_flag == 1){
                echo '<h7>エラーが発生したためアカウントの更新が登録できません。<br>
            '.$update_error_message.'</h7>';
            }else{
                echo '<h4>アカウントの更新が完了しました。</h4>';
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