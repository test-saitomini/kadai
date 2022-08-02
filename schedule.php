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
                
                <h1>予定入力フォーム</h1>
                予定を入力する画面です。日付と予定の見出し、内容、必要であればURLを張り付けてください。
                <br>
                <h7>*</h7>は必須項目になっています。
                <form method="post" action="schedule_complete.php" name="schedule">
                    <table class = "box">
                        <tr>
                        <div class="textarea">
                            <td><label>日付（開始）</label><h7>*</h7></td>
                                <td><input type="date"list="daylist" min="" name="day_kaishi"id="day_kaishi"value="<?php if( !empty($_POST['day_kaishi']) ){ echo $_POST['day_kaishi']; } ?>"><br>
                            <span id = 'day_kaishi_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>日付（終了）</label><h7>*</h7></td>
                            <td><input type="date"list="daylist" min="" name="day_owari"id="day_owari"value="<?php if( !empty($_POST['day_owari']) ){ echo $_POST['day_owari']; } ?>"><br>
                            <span id = 'day_owari_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>予定の見出し</label><h7>*</h7></td>
                            <td><input type="text"class="text" size="45"name="yotei"id="yotei"value="<?php if( !empty($_POST['yotei']) ){ echo $_POST['yotei']; } ?>"><br>
                            <span id = 'yotei_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>内容</label></td>
                            <td><textarea name="naiyou" cols="50" rows="5" id="naiyou"value="<?php if( !empty($_POST['naiyou']) ){ echo $_POST['naiyou']; } ?>"></textarea><br>
                            <span id = 'naiyou_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>URL</label></td>
                            <td><input type="text"class="text" size="45"name="url"id="url"value="<?php if( !empty($_POST['url']) ){ echo $_POST['url']; } ?>"><br>
                            <span id = 'url_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        </table>
                        <table class="loginbutton">
                    <tr>
                        <td></td>
                        <div class="textarea">
                            <td><input type="submit" class="btn_submit" id="btn_confirm" value="確認する">
                            <input type="hidden" value="0" name="yotei_delete_flg"></td>
                        </div>
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
            Copyright D.I.Works| portfolio_趣味-calendar_saito
        </footer>
        <script type="text/javascript" src="regist_check_schedule.js"></script>
    </body>
</html>