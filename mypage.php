<?php
mb_language('ja');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

session_start();

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    }else{
    $login_account = "0";
    $login_mail= NULL;
}

$pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");

$stmt = $pdo -> prepare('select * from account where mail = ?');
$stmt ->execute(array($login_mail));

$mypage = $stmt -> fetch();

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
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
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
        
        <main>
            <div class = "main-container">
                <?php echo $mypage['name']; ?>さんの会員情報の詳細です。<br>情報を更新またはアカウント削除する場合は下のボタンを押してください。<br>
                <table class="box2">
                    <tr>
                        <td><label>名前</label></td>
                        <td><?php echo $mypage['name']; ?></td>
                    </tr>
                    <tr>
                        <td><label>メールアドレス</label></td>
                        <td><?php  echo $mypage['mail']; ?></td>
                    </tr>
                    <tr>
                       <td><label>パスワード</label></td>
                        <td><h7>※セキュリティ上、パスワードを非表示にしています。</h7></td>
                    </tr>
                </table>
                <table class="button">
                    <tr>
                        <td>
                            <form action="top.php" >
                                <input type="submit" class="submit" value="トップページへ戻る">
                            </form>
                        </td>
                        <td>
                            <form action="account_update.php" method="post">
                                <input type="hidden" name = "id" value="<?php echo $mypage['id'];?>">
                                <input type="submit" value="アカウント更新">
                            </form>
                        </td>
                        <td>
                            <form action="account_delete.php" method="post">
                                <input type="hidden" name = "id" value="<?php echo $mypage['id'];?>">
                                <input type="submit" value="アカウント削除">
                            </form>
                        </td>
                    </tr>
                </table>
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
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>