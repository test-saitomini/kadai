<?php
session_start();

$pdo = new PDO("mysql:dbname=heroku_7f44de0a892964f;host=us-cdbr-east-06.cleardb.net;charset=utf8","b51f5ef5ea5d11","5edf58c2");

//エラーメッセージの初期化
$login_error = array();
$login_error_flag = 0;


// ログインボタンが押されたら
if (isset($_POST['login'])) {

   //エラー文
    if (empty($_POST['mail'])) {
       $login_error['mail'] = 'メールアドレスが未入力です。';
    } 
    if (empty($_POST['password'])) {
       $login_error['password'] = 'パスワードが未入力です。';
    }
    
    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = $_POST['mail'];
        try {
            $pdo -> beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM account WHERE mail = :mail");
            $stmt -> bindValue(':mail', $mail, PDO::PARAM_STR);
            $stmt -> execute();

            $password = $_POST['password'];
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!empty($result['password'])){
                if (password_verify($password, $result['password'])) {
                    if($result['account_delete_flg'] == 0){
                        $_SESSION['name'] = $result['name'];
                        $_SESSION['authority'] = $result['authority'];
                        $_SESSION['mail'] = $result['mail'];
                        header('Location: ./top.php');
                        exit();
                    }else{
                        $login_error['login'] = 'アカウントはすでに削除されています。';
                    }
                    
                } else {
                    $login_error['login'] = 'メールアドレスまたはパスワードに誤りがあります。';
                }
            }else{
                $login_error['login'] = 'メールアドレスまたはパスワードに誤りがあります。';
            }

            /*if (password_verify($password, $result['password'])) {    
                $_SESSION['authority'] = $result['authority'];
                header('Location: regist_top.php');
                exit();
            } else {
                $login_error['login'] = 'メールアドレスまたはパスワードに誤りがあります。';
            }*/
        } catch (PDOException $Exception) {
            $login_error_message = $Exception->getMessage();
            $login_error_flag = 1;
        }
    }
}

//セッションの中身を消す
//$_SESSION = array();
//セッションクリア
//session_destroy();

?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>趣味カレンダー_ポートフォリオ</title>
    <link rel="stylesheet"type="text/css" href="regist.css">
</head>
    
    <body>
        <header>
            <ul>
                <li><a href = "https://heroku-portfolio-app.herokuapp.com/top.php">トップ</a></li>
                <li><a href="https://heroku-portfolio-app.herokuapp.com/regist.php">会員登録</a></li>
                <li> </li>
            </ul>
        </header>
        
        <main>
            <div class = "main-container">
            <h1>ログイン画面</h1>
            <div class="form">
            <form id="loginForm" name="loginForm" action="" method="POST">
               <?php
                foreach($login_error as $error){
                    print "<p class='login_error'>";
                    print "<h7>".$error."</h7><br>";
                    print "</p>";
                }
                if($login_error_flag == 1){
                    echo '<h7>エラーが発生したためログイン情報を取得できません。<br>'.$login_erorr_message.'<br></h7>';
                };

               ?>

                <table class="box">
                    <tr>
               <div>
                   <td><label for="mail">メールアドレス</label></td>
                   <td><input type="text" id="mail" name="mail" placeholder="メールアドレス" value="<?php if (!empty($_POST["mail"])) {echo $_POST["mail"];} ?>"></td>
                   
               </div>

                        </tr>
                    <tr>
               <div>
                   <td><label for="password">パスワード</label></td>
                   <td><input type="password" id="password" name="password" value="" placeholder="パスワード"></td>
                   
               </div>
                        </table>
                <table class="loginbutton">
                    <tr>
                        <td></td>
                        <td><input type="submit" id="login" name="login" value="ログイン"></td>
                    </tr>
                </table>
                   
            </form>
            </div>
            <br>
            新規会員登録は<a href="https://heroku-portfolio-app.herokuapp.com/regist.php">コチラ</a>
            <br>
            パスワードを忘れた方は<a href="https://heroku-portfolio-app.herokuapp.com/password_resetting.php">コチラ</a>
            </div>
        </main>
        
        <footer>
            Copyright D.I.Works| portfolio_趣味-calendar_saito
        </footer>
        <script type="text/javascript" src="regist.js"></script>
    </body>
</html>