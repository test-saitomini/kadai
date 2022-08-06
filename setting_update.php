<?php

session_start();

if($_SESSION != NULL){
    $login_account = "1";
    $login_mail = $_SESSION["mail"];
    $login_authority = $_SESSION["authority"];
    }else{
    $login_account = "0";
    $login_mail= NULL;
}

$id = $_POST['id'];
            
$pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;charset=utf8","b51f5ef5ea5d11","5edf58c2");
            
$stmt = $pdo -> query('select * from setting where id = '.$id);
$update = $stmt->fetch();

?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>趣味カレンダー_ポートフォリオ</title>
        <link rel="stylesheet"type="text/css"href="regist.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
    <?php if($login_account == 0) : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/login.php">ログイン</a></li>
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
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/setting.php">設定</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <main>
            <div class = "main-container">
                <form action="setting_update_confirm.php" method="post">
                    <table class="box">
                        <tr>
                    <div class="textarea">
                        <td><label>日付（開始）</label><h7>*</h7></td>
                            <td><input type="date"list="daylist" min="" name="day_kaishi"id="day_kaishi"value="<?php if( !empty($update['day_kaishi']) ){ echo $update['day_kaishi']; } ?>"><br>
                        <span id = 'day_kaishi_error' class="error_m"></span></td>
                        </div>
                            </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>日付（終了）</label><h7>*</h7></td>
                            <td><input type="date"list="daylist" min="" name="day_owari"id="day_owari"value="<?php if( !empty($update['day_owari']) ){ echo $update['day_owari']; } ?>"><br>
                            <span id = 'day_owari_error' class="error_m"></span></td>
                        </div>
                        </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>見出し</label><h7>*</h7></td>
                            <td><input type="text"class="text" size="45"name="midashi"id="midashi"value="<?php if( !empty($update['midashi']) ){ echo $update['midashi']; } ?>"><br>
                            <span id = 'midashi_error' class="error_m"></span></td>
                        </div>
                    </tr>
                        <tr>
                        <div class="textarea">
                            <td><label>内容</label></td>
                            <td><textarea cols="50" rows="5" name="naiyou"id="naiyou"><?php if( !empty($update['naiyou']) ){ echo $update['naiyou']; } ?></textarea><br>
                            <span id = 'naiyou_error' class="error_m"></span></td>
                        </div>
                </tr>
                        </table>
                        <table class="loginbutton">
                    <tr>
                        <td></td>
                        <div class="textarea">
                            <td><input type="submit" class="btn_submit" id="btn_confirm" value="確認する">
                            <input type="hidden" name = "id" value="<?php echo $id;?>"></td>
                        </div>
                    </tr>
                </table> 
                </form>
            </div>
        </main>
        <?php else : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <main>
            <div class = "main-container">
                <h8>※この画面は操作できません。</h8>
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
        <?php else : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/login.php">ログイン</a></li>
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
        <script type="text/javascript" src="regist_check_setting.js"></script>
    </body>
</html>