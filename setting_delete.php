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

$id = $_POST['id'];

$pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;","b51f5ef5ea5d11","5edf58c2");
            
$stmt = $pdo -> query('select * from setting where id = '.$id);
$delete = $stmt->fetch();

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
        <main>
            <div class = "main-container">
                こちらは削除をする画面です。<br>予定を削除してもよろしければ下の確認ボタンを押してください。
                <form action="setting_delete_confirm.php" method="post">
                    <table class="box2">
                        <tr>
                            <div class="textarea">
                                <td><label>日付（開始）</label></td>
                                <td><?php echo $delete['day_kaishi']; ?></td>
                            </div>
                        </tr>
                        <tr>
                            <div class="textarea">
                                <td><label>日付（終了）</label></td>
                                <td><?php echo $delete['day_owari']; ?></td>
                            </div>
                        </tr>
                        <tr>
                            <div class="textarea">
                                <td><label>予定の見出し</label></td>
                                <td><?php echo $delete['midashi']; ?></td>
                                </div>
                        </tr>
                            <tr>
                                <div class="textarea">
                            <td><label>内容</label></td>
                                <td><?php echo $delete['naiyou']; ?></td>
                        </div>
                    </tr>
                        
                        </table>
                        <table class="loginbutton">
                    <tr>
                        <td></td>
                        <div class="textarea">
                           <td><input type="submit" class="btn_submit" id="btn_confirm" value="確認する">
                            <input type="hidden" name = "id" value="<?php echo $id;?>">
                            <input type="hidden" value="1" name="set_delete_flg"></td>
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
                        <li><a href = "http://localhost/kadai/mypage.php">マイページ</a></li>
                        <li><a href = "http://localhost/kadai/logout.php">ログアウト</a></li>
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
            <script type="text/javascript" src="regist_check_setting.js"></script>
        </body>
    </html>