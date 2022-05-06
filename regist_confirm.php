<?php
mb_language('ja');
mb_internal_encoding("UTF-8");

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
        <title>アカウント登録確認画面</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    </head>
    <body>
        
        <?php if($login_account == 0) : ?>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
            </ul>
        </header>
        <div class = "main-container">
        <?php if($_POST != NULL) : ?>
        <h2>アカウント登録内容の確認</h2>
        <p>アカウント登録はこちらでよろしいでしょうか？
        <br>よろしければ「登録する」ボタンを押してください。
        </p>
        <div class = kakunin>
        <p>名前
        <br>
        <?php echo $_POST['name'];?>
        </p> 
        <p>メールアドレス
        <br>
        <?php echo $_POST['mail'];?>
        </p>
        <p>パスワード
        <br>
        <?php
            $password = $_POST['password'];
            for($i=0;$i< mb_strlen($password);$i++){
            echo '●';}?>
        </p>
        <p>アカウント権限
        <br>
        <?php if($_POST['authority']==="0"){
            echo'一般';
        }else{
            echo '管理者'; 
        }?>
        
        <input type="submit" onclick=history.back() value="戻って修正する">
            
        <form action="regist_complete.php" method="post">
            <input type="submit" name="btn_submit" value="登録する">
            <input type="hidden" value="<?php echo $_POST['name'];?>" name="name">
            <input type="hidden" value="<?php echo $_POST['mail'];?>" name="mail">
            <input type="hidden" value="<?php echo $_POST['password'];?>" name="password">
        </form>
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
                <h8>※何らかのエラーが発生しています。<br>
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
    </body>
    <footer>
            Copyright D.I.Works| D.I.blog is the one which provides Ato Z about programming
    </footer>
</html>