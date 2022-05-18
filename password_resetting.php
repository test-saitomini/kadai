<?php
session_start();

$pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");

//エラーメッセージの初期化
$kakunin_error = array();
$kakunin_error_flag = 0;


// ログインボタンが押されたら
if (isset($_POST['kakunin'])) {

   //エラー文
    if (empty($_POST['mail'])) {
       $kakunin_error['mail'] = 'メールアドレスが未入力です。';
    } 
    if (empty($_POST['name'])) {
       $kakunin_error['name'] = 'パスワードが未入力です。';
    }
    
    $mail_mblen = mb_strlen($_POST['mail']);
    $name_mblen = mb_strlen($_POST['name']);
    
    if($mail_mblen > 100){
        $kakunin_error['mail'] = 'メールアドレスは100文字以内で入力してください。';
    }
    if ($name_mblen > 100) {
       $kakunin_error['name'] = '名前は100文字以内で入力してください。';
    }
    
    if (!empty($_POST['mail']) && !empty($_POST['name'])) {
        $mail = $_POST['mail'];
        try {
            $pdo -> beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM account WHERE mail = :mail");
            $stmt -> bindValue(':mail', $mail, PDO::PARAM_STR);
            $stmt -> execute();

            $name = $_POST['name'];
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!empty($result['name'])){ 
                if($result['name'] == $name){
                    $_SESSION['name'] = $result['name'];
                    $_SESSION['authority'] = $result['authority'];
                    $_SESSION['mail'] = $result['mail'];
                    $_SESSION['id'] = $result['id'];
                    header('Location: password_resetting_confirm.php');
                    exit();
                }else{
                $kakunin_error['kakunin'] = '名前またはメールアドレスに誤りがあります。';
                } 
            }else{
                $kakunin_error['kakunin'] = '名前またはメールアドレスに誤りがあります。';
            }

            /*if (name_verify($name, $result['name'])) {    
                $_SESSION['authority'] = $result['authority'];
                header('Location: regist_top.php');
                exit();
            } else {
                $kakunin_error['kakunin'] = 'メールアドレスまたはパスワードに誤りがあります。';
            }*/
        } catch (PDOException $Exception) {
            $kakunin_error_message = $Exception->getMessage();
            $kakunin_error_flag = 1;
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
    <title>パスワード再設定画面</title>
    <link rel="stylesheet"type="text/css" href="regist.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
</head>
    
    <body>
        <header>
            <ul>
                <li><a href = "http://localhost/kadai/top.php">トップ</a></li>
                <li><a href="http://localhost/kadai/regist.php">会員登録</a></li>
                <li> </li>
            </ul>
        </header>
        
        <main>
            <div class = "main-container">
            <h1>パスワード再設定情報画面</h1>
            <div class="form">
            <form id="kakuninForm" name="kakuninForm" action="" method="POST">
               <?php
                foreach($kakunin_error as $error){
                    print "<p class='kakunin_error'>";
                    print "<h7>".$error."</h7><br>";
                    print "</p>";
                }
                if($kakunin_error_flag == 1){
                    echo '<h7>エラーが発生したためパスワード再設定のための情報が得られません。<br>'.$kakunin_erorr_message.'<br></h7>';
                };

               ?>
                <div>
                   <label for="name">名前
                   <input type="name" id="name" name="name" value="" placeholder="名前">
                   </label>
               </div>

               <div>
                   <label for="mail">メールアドレス
                   <input type="text" id="mail" name="mail" placeholder="メールアドレス" value="<?php if (!empty($_POST["mail"])) {echo $_POST["mail"];} ?>">
                   </label>
                </div>
                <input type="submit" id="kakunin" name="kakunin" value="確認する">
            </form>
            </div>
            </div>
        </main>
        
        <footer>
            Copyright D.I.Works| D.I.blog is the one which provides Ato Z about programming
        </footer>
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>