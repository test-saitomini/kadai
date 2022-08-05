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
        <?php 
        $id = $_GET['id'];
        //$day = new DateTime($date);
        $pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;charset=utf8","b51f5ef5ea5d11","5edf58c2");
            
        //$stmt = $pdo -> query("select * from setting where day_kaishi = DATE(".$day.",'%Y-%m-%d')");
        $stmt = $pdo -> prepare("select * from setting where id = ? AND set_delete_flg = 0");
        $stmt -> execute(array($id));
        
        $set = $stmt -> fetch();
        ?>
        
        <?php if($login_account == 0) : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/login.php">ログイン</a></li>
            </ul>
        </header>
        <main>
            <div class = "main-container">
                予定の詳細です。
                <form>
                    <table class="box2">
                        <tr>
                            <td><label>日付（開始）</label></td>
                            <td><?php echo $set['day_kaishi']; ?></td>
                        </tr>
                        <tr>
                            <td><label>日付（終了）</label></td>
                            <td><?php  echo $set['day_owari']; ?></td>
                        </tr>
                        <tr>
                            <td><label>見出し</label></td>
                            <td><?php echo $set['midashi']; ?></td>
                        </tr>
                        <tr>
                            <td><label>内容</label></td>
                            <td><?php echo $set['naiyou']; ?></td>
                        </tr>
                    </table>
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
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/setting.php">設定</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <?php else : ?>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <?php endif; ?>
        <main>
            <div class = "main-container">
                予定の詳細です。
                <form>
                    <table class="box2">
                        <tr>
                            <td><label>日付（開始）</label></td>
                           <td><?php echo $set['day_kaishi']; ?></td>
                        </tr>
                        <tr>
                            <td><label>日付（終了）</label></td>
                            <td><?php  echo $set['day_owari']; ?></td>
                        </tr>
                        <tr>
                            <td><label>見出し</label></td>
                            <td><?php echo $set['midashi']; ?></td>
                        </tr>
                        <tr>
                            <td><label>内容</label></td>
                            <td><?php echo $set['naiyou']; ?></td>
                        </tr>
                    </table>
                </form>
                <table class="button">
                    <tr>
                        <td>
                            <form action="top.php" >
                                <input type="submit" class="submit" value="トップページへ戻る">
                            </form>
                        </td>
                        <?php if($login_authority == 1) : ?>
                        <td>
                            <form action="setting_update.php" method="post">
                                <input type="hidden" name = "id" value="<?php echo $set['id'];?>">
                                <input type="submit" value="更新">
                            </form>
                        </td>
                        <td>
                            <form action="setting_delete.php" method="post">
                                <input type="hidden" name = "id" value="<?php echo $set['id'];?>">
                                <input type="submit" value="削除">
                            </form>
                        </td>
                    </tr>
                </table>
                </div>
        </main>
        <?php else : ?>
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