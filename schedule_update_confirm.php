<?php

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
                <h8>※ログインを行ってください。</h8>
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
            <br>
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
        <div class = "main-container">
            <?php if($_POST != NULL) : ?>
            <h2>編集する内容の確認</h2>
            <p>編集する内容はこちらでよろしいでしょうか？
                <br>よろしければ「登録する」ボタンを押してください。
            </p>
                <table class="box2">
                    <tr>
                        <td>日付（開始）</td>
                        <td><?php echo $_POST['day_kaishi'];?></td>
                        </tr>
                    <tr>
                        <td>日付（終了）</td>
                        <td><?php echo $_POST['day_owari'];?></td>
                    </tr>
                    <tr>
                        <td>予定の見出し</td>
                        <td><?php echo $_POST['yotei'];?></td>
                    </tr>
                    <tr>
                        <td>詳細内容</td>
                        <td><?php echo $_POST['naiyou'];?></td>
                    </tr>
                    <tr>
                        <td>URL</td>
                        <td><?php echo $_POST['url'];?></td>
                    </tr>
                </table>
                <table class="button">
                    <tr>
                        <td>
                            <input type="submit" onclick=history.back() value="戻って修正する">
                        </td>
                        <td>
                            <form action="schedule_update_complete.php" method="post">
                                <input type="submit" name="btn_submit" value="登録する">
                                <input type="hidden" name = "id" value="<?php echo $_POST['id'];?>">
                                <input type="hidden" value="<?php echo $_POST['day_kaishi'];?>" name="day_kaishi">
                                <input type="hidden" value="<?php echo $_POST['day_owari'];?>" name="day_owari">
                                <input type="hidden" value="<?php echo $_POST['yotei'];?>" name="yotei">
                                <input type="hidden" value="<?php echo $_POST['naiyou'];?>" name="naiyou">
                                <input type="hidden" value="<?php echo $_POST['url'];?>" name="url">
                            </form>
                        </td>
                    </tr>
                </table>
        <?php endif; ?>
        </div> 
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
                <h8>※何らかのエラーが発生しています。<br>
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
    </body>
    <footer>
            Copyright D.I.Works| portfolio_趣味-calendar_saito
    </footer>
</html>