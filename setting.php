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
        <title>新規会員登録画面</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <?php if($login_account == 0) : ?>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li>会員登録</li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
            </ul>
        </header>
        <main>
            
            <br>
        </main>
        <?php elseif($login_account == 1) : ?>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li>会員登録</li>
                <li><a href = "http://localhost/kadai/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <main>
            <form method="post" action="regist_confirm.php" name="regist">
                <h1>カレンダー設定フォーム</h1>
                カレンダーの設定を行います。<br>カレンダーの日付やイベントの内容を入力し、間違えがなければ「確認」ボタンを押下してください。<br>
                <h7>*</h7>は必須項目になっています。
                <div class = "box">
                    <div class="textarea">
                        <label>日付（開始）</label><h7>*</h7>
                        <input type="date"list="daylist" min="" name="day_kaishi"id="day_kaishi"value="<?php if( !empty($_POST['day_kaishi']) ){ echo $_POST['day_kaishi']; } ?>"><br>
                        <span id = 'day_kaishi_error' class="error_m"></span><br>
                    </div>
                    <div class="textarea">
                        <label>日付（終了）</label><h7>*</h7>
                        <input type="date"list="daylist" min="" name="day_owari"id="day_owari"value="<?php if( !empty($_POST['day_owari']) ){ echo $_POST['day_owari']; } ?>"><br>
                        <span id = 'day_owari_error' class="error_m"></span><br>
                    </div>
                    <div class="textarea">
                        <label>見出し</label><h7>*</h7>
                        <input type="text"class="text" size="10"name="mail"id="mail"value="<?php if( !empty($_POST['mail']) ){ echo $_POST['mail']; } ?>"><br>
                        <span id = 'mail_error' class="error_m"></span><br>
                    </div>
                    <div class="textarea">
                        <label>詳細内容</label><h7>*</h7>
                        <input type="password"class="text" size="10"name="password"id="password"value="<?php if( !empty($_POST['password']) ){ echo $_POST['password']; } ?>"><br>
                        <span id = 'password_error' class="error_m"></span><br>
                    </div>
                    <div class="textarea">
                        <input type="submit" class="btn_submit" id="btn_confirm" value="確認する">
                    </div>
                </div>
            </form>
        </main>
        <?php else : ?>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li>会員登録</li>
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
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>