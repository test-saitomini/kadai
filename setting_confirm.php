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
        <title>趣味カレンダー_ポートフォリオ</title>
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
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/mypage.php">マイページ</a></li>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/logout.php">ログアウト</a></li>
            </ul>
        </header>
        <?php if($login_authority == 1) : ?>
        <div class = "main-container">
            <?php if($_POST != NULL) : ?>
            <h2>設定する内容の確認</h2>
            <p>設定する内容はこちらでよろしいでしょうか？
                <br>よろしければ「登録する」ボタンを押してください。
            </p>
            <div class = kakunin>
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
                        <td>見出し</td>
                        <td><?php echo $_POST['midashi'];?></td>
                    </tr>
                    <tr>
                        <td>詳細内容</td>
                        <td><?php echo $_POST['naiyou'];?></td>
                    </tr>
                </table>
        <table class="button">
            <tr>
                <td>
                    <input type="submit" onclick=history.back() value="戻って修正する">
                </td>
                <td>
                    <form action="setting_complete.php" method="post">
                        <input type="submit" name="btn_submit" value="登録する">
                        <input type="hidden" value="<?php echo $_POST['day_kaishi'];?>" name="day_kaishi">
                        <input type="hidden" value="<?php echo $_POST['day_owari'];?>" name="day_owari">
                        <input type="hidden" value="<?php echo $_POST['midashi'];?>" name="midashi">
                        <input type="hidden" value="<?php echo $_POST['naiyou'];?>" name="naiyou">
                        <input type="hidden" value="0" name="set_delete_flg">
                    </form>
                </td>
            </tr>
            </table>
        </div>
            <?php endif; ?>
        </div>
        <?php else : ?>
        <main>
            <div class="error_messge">
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
            <br>
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