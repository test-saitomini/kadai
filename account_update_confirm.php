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
            <h4>この内容に変更します。<br>よろしければ下の登録するボタンを押してください。</h4>
                <div class = kakunin>
                    <table class="box2">
                        <tr>
                        <td>名前</td>
                        <td><?php echo $_POST['name'];?></td>
                        </tr>
                    <tr>
                    <td>メールアドレス</td>
                        <td><?php echo $_POST['mail'];?></td>
                    </tr>
                    <tr>
                    <td>パスワード</td>
                        <td><?php
            
                        if(isset($_POST['password_check'])){
                            $password = $_POST['password'];
                            for($i=0;$i< mb_strlen($password);$i++){
                                echo '●';}
                            $_POST['password_check'] = 1;
                        }else{
                            echo '<h7>パスワードは変更されません。</h7>';
                            $_POST['password_check'] = 0;
                        }
                        ?></td>
                    </tr>
                    </table>
                    
                    <table class="button">
                        <tr>
                            <td>
                                <input type="submit" onclick=history.back() value="戻って修正する">
                            </td>
                            <td>
                                <form action="account_update_complete.php" method="post">
                                    <input type="submit" name="btn_submit" value="登録する">
                                    <input type="hidden" name = "id" value="<?php echo $_POST['id'];?>">
                                    <input type="hidden" value="<?php echo $_POST['name'];?>" name="name">
                                    <input type="hidden" value="<?php echo $_POST['mail'];?>" name="mail">
                                    <input type="hidden" value="<?php echo $_POST['password_check'];?>" name="password_check">
                                    <input type="hidden" value="<?php echo $_POST['password'];?>" name="password">
                                    <input type="hidden" value="0" name="account_delete_flg">
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
            Copyright D.I.Works| portfolio_TDR-calendar
        </footer>
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>