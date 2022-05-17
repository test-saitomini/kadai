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
        <title> 予定入力画面</title>
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
                <li><a href = "http://localhost/kadai/regist.php">会員登録</a></li>
                <li><a href = "http://localhost/kadai/login.php">ログイン</a></li>
            </ul>
        </header>
        <main>
            <div class="error_messge">
                <h8>※アカウントをログインしてから行ってください。</h8>
                <form action="login.php" >
                    <input type="submit" class="submit" value="ログイン画面へ戻る">
                </form>
                <form action="top.php" >
                    <input type="submit" class="submit" value="トップページへ戻る">
                </form>
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
                
                <h1>予定入力フォーム</h1>
                予定を入力する画面です。日付と予定の見出し、内容、必要であればURLを張り付けてください。
                <br>
                <h7>*</h7>は必須項目になっています。
                <form method="post" action="schedule_complete.php" name="schedule">
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
                            <label>予定の見出し</label><h7>*</h7>
                            <input type="text"class="text" size="10"name="yotei"id="yotei"value="<?php if( !empty($_POST['yotei']) ){ echo $_POST['yotei']; } ?>"><br>
                            <span id = 'yotei_error' class="error_m"></span><br>
                        </div>
                        <div class="textarea">
                            <label>内容</label>
                            <input type="text"class="text" size="10"name="naiyou"id="naiyou"value="<?php if( !empty($_POST['naiyou']) ){ echo $_POST['naiyou']; } ?>"><br>
                            <span id = 'naiyou_error' class="error_m"></span><br>
                        </div>
                        <div class="textarea">
                            <label>URL</label>
                            <input type="text"class="text" size="10"name="url"id="url"value="<?php if( !empty($_POST['url']) ){ echo $_POST['url']; } ?>"><br>
                            <span id = 'url_error' class="error_m"></span><br>
                        </div>
                
                        <div class="textarea">
                            <input type="submit" class="btn_submit" id="btn_confirm" value="確認する">
                            <input type="hidden" value="0" name="yotei_delete_flg">
                        </div>
                    </div>
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
        <script type="text/javascript" src="regist_check_schedule.js"></script>
    </body>
</html>