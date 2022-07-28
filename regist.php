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
            <div class = "main-container">
            <form method="post" action="regist_confirm.php" name="regist">
                <h1>会員登録入力フォーム</h1>
                会員登録を行います。<br>必要事項を入力し、間違えがなければ「確認」ボタンを押下してください。<br>
                <h7>*</h7>は必須項目になっています。
                <br>
                <table class = "box">
                    <tr>
                    <div class="textarea">
                        <td><label>名前</label><h7>*</h7></td>
                        <td><input type="text"class="text"size="45"name="name"id="name"value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>"><br>
                        <span id = 'name_error' class="error_m"></span></td>
                    </div>
                    </tr>
                    <tr>
                    <div class="textarea">
                        <td><label>メールアドレス</label><h7>*</h7></td>
                        <td><input type="text"class="text" size="45"name="mail"id="mail"value="<?php if( !empty($_POST['mail']) ){ echo $_POST['mail']; } ?>"><br>
                        <span id = 'mail_error' class="error_m"></span></td>
                    </div>
                    </tr>
                    <tr>
                    <div class="textarea">
                        <td><label>パスワード</label><h7>*</h7></td>
                        <td><input type="password"class="text" size="45"name="password"id="password"value="<?php if( !empty($_POST['password']) ){ echo $_POST['password']; } ?>"><br>
                        <span id = 'password_error' class="error_m"></span></td>
                    </div>
                    </tr>
                    <tr>
                    <div class="textarea"> 
                        <td><label>もう一度パスワードを入力してください。</label><h7>*</h7></td>
                        <td><input type="password"class="text" size="45"name="password_re"id="password_re"value="<?php if( !empty($_POST['password_re']) ){ echo $_POST['password_re']; } ?>"><br>
                        <span id = 'password_re_error' class="error_m"></span></td>
                    </div>
                        </table>
                <table class="loginbutton">
                    <tr>
                        <td></td>
                        <td><input type="submit" class="btn_submit" id="btn_confirm" value="確認する"></td>
                    </tr>
                </table>
            </form>
            <br>
                </div>
        </main>
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