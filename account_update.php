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
        <?php 
        $id = $_POST['id'];

        $pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");
            
        $stmt = $pdo -> query('select * from account where id = '.$id);
        $update = $stmt->fetch();
        ?>
        
        <main>
            <div class = "main-container">
                <form action="account_update_confirm.php" method="post">
                    <table class="box">
                        <tr>
                        <div class="textarea">
                            <td><label>名前</label><h7>*</h7></td>
                            <td><input type="text"class="text"size="45"name="name"id="name"value="<?php if( !empty($update['name']) ){ echo $update['name']; } ?>"><br>
                            <span id = 'name_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>メールアドレス</label><h7>*</h7></td>
                            <td><input type="text"class="text" size="45"name="mail"id="mail"value="<?php if( !empty($update['mail']) ){ echo $update['mail']; } ?>"><br>
                        <span id = 'mail_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>パスワード</label><h7>*</h7></td>
                            <td><input type = "checkbox" name = "password_check" id = "password_check">※パスワードを変更する場合は左のチェックボックスにチェックをしてください。<br>
                        <!--変更したいのと変更したくない場合どのようにすべきか -->
                            <div class="password_area">
                                <input type="password"class="text" size="45"
                               name="password"id="password"
                               value="<?php if( !empty($_POST['password']) ){ echo $_POST['password'];} ?>">
                                <span id = 'password_error' class="error_m"></span>
                                <br>
                                <label>確認のため、もう一度パスワードを入力してください。</label><h7>*</h7><br>
                                <input type="password"class="text" size="45"name="password_re"id="password_re"value="<?php if( !empty($_POST['password_re']) ){ echo $_POST['password_re']; } ?>"><br>
                                <span id = 'password_re_error' class="error_m"></span>
                            </div>
                        </div>
                        </tr>
                        </table>
                <table class="loginbutton">
                    <tr>
                        <td></td>
                        <td><div class="textarea">
                            <td><input type="submit" class="btn_submit" id="btn_confirm" value="確認する">
                            <input type="hidden" name = "id" value="<?php echo $id;?>"></td>
                        </div></td>
                    </tr>
                </table>
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