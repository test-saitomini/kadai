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

function getreservation(){
    $pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");

    $schedule = $pdo -> query('select * from setting');
    $reservation_midashi = array();

    foreach($schedule as $out){
        $day_out = strtotime((string) $out['day_kaishi']);
        $midashi_out = (string) $out['midashi'];
        $set_delete_flg_out = (int) $out['set_delete_flg'];
        if($set_delete_flg_out == 0){
            $reservation_midashi[date('Y-m-d', $day_out)] = $midashi_out;
        }
    }
    ksort($reservation_midashi);
    return $reservation_midashi;
}

$reservation_array = getreservation();
//getreservation関数を$reservation_arrayに代入しておく
 
function reservation($date,$reservation_array){
    //カレンダーの日付と予約された日付を照合する関数
    
    if(array_key_exists($date,$reservation_array)){
        $reservation_midashi = $reservation_array[$date];
            
        return $reservation_midashi;
    }
}

if($login_mail != NULL){
    function getyotei(){
        global $login_mail;
        $mail = $login_mail;
        
        $pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");

        $yotei = $pdo -> prepare('select * from schedule where mail = ?');
        $yotei ->execute(array($mail));
        
        $reseryotei = array();
        
        foreach($yotei as $out){
            $day_out = strtotime((string) $out['day_kaishi']);
            $yotei_out = (string) $out['yotei'];
            $yotei_delete_flg_out = (int) $out['yotei_delete_flg'];
            if($yotei_delete_flg_out == 0){
                $reseryotei[date('Y-m-d', $day_out)] = $yotei_out;
            }
        }
        ksort($reseryotei);
        return $reseryotei;
    }
    
    $reseryotei_array = getyotei();
    
    function reseryotei($date,$reseryotei_array){
    //カレンダーの日付と予約された日付を照合する関数
    
        if(array_key_exists($date,$reseryotei_array)){
            //もし"カレンダーの日付"と"予約された日"が一致すれば以下を実行する
            $reseryotei = $reseryotei_array[$date];
            return $reseryotei;
        }
    }
    
    function getyotei_owari(){
        global $login_mail;
        $mail = $login_mail;
        
        $pdo = new PDO("mysql:dbname=portfolio;host=localhost;","root","");

        $yotei = $pdo -> prepare('select * from schedule where mail = ?');
        $yotei ->execute(array($mail));
        
        $reseryotei_owari = array();
        
        foreach($yotei as $out){
            $day_out = strtotime((string) $out['day_kaishi']);
            $day2_out = strtotime((string) $out['day_owari']);
            $yotei_out = (string) $out['yotei'];
            $yotei_delete_flg_out = (int) $out['yotei_delete_flg'];
            if($yotei_delete_flg_out == 0 && $day_out != $day2_out){
                $reseryotei_owari[date('Y-m-d', $day2_out)] = $yotei_out;
            }
        }
        ksort($reseryotei_owari);
        return $reseryotei_owari;
    }
    
    $reseryotei_owari_array = getyotei_owari();
    
    function reseryotei_owari($date,$reseryotei_owari_array){
    //カレンダーの日付と予約された日付を照合する関数
    
        if(array_key_exists($date,$reseryotei_owari_array)){
            //もし"カレンダーの日付"と"予約された日"が一致すれば以下を実行する
            $reseryotei_owari = $reseryotei_owari_array[$date];
            return $reseryotei_owari;
        }
    }
    
}

//GoogleカレンダーAPIから祝日を取得
 
$year = date("Y");
 
function getHolidays($year) {//その年の祝日を全て取得する関数を作成
	
	$api_key = 'AIzaSyC9d5DWJMOGtInRqE-FVDAhTQbfGRgAI2k'; //取得したAPIを入れる
	$holidays = array(); //祝日を入れる配列の箱を用意しておく
	$holidays_id = 'japanese__ja@holiday.calendar.google.com';
	$url = sprintf(
        //sprintf関数を使用しURLを設定
        //このURLはGoogleカレンダー独自のURL
        //Googleカレンダーから祝日を調べるURL
        'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
		'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
		$holidays_id,
		$api_key,
		$year.'-01-01T00:00:00Z' , // 取得開始日
		$year.'-12-31T00:00:00Z' , // 取得終了日
		150 // 最大取得数
	);
 
	if ( $results = file_get_contents($url, true )) {
        //file_get_contents関数を使用
        //URLの中に情報が入っていれば（trueなら）以下を実行する
		$results = json_decode($results);
        //JSON形式で取得した情報を配列に格納
		foreach ($results->items as $item ) {
			$date = strtotime((string) $item->start->date);
			$title = (string) $item->summary;
			$holidays[date('Y-m-d', $date)] = $title;
            //年月日をキー、祝日名を配列に格納
		}
		ksort($holidays);
        //祝日の配列を並び替え
        //ksort関数で配列をキーで逆順に（１月からの順番にした）
	}
	return $holidays; 
}



$Holidays_array = getHolidays($year); 
//getHolidays関数を$Holidays_arrayに代入して使用しやすいようにしておく
 
 
//その日の祝日名を取得
function display_to_Holidays($date,$Holidays_array) {
    //※引数1は日付"Y-m-d"型、引数に2は祝日の配列データ
    //display_to_Holidays("Y-m-d","Y-m-d") →引数1の日付と引数2の日付が一致すればその日の祝日名を取得する
    
	if(array_key_exists($date,$Holidays_array)){
        //array_key_exists関数を使用
        //$dateが$Holidays_arrayに存在するか確認
        //各日付と祝日の配列データを照らし合わせる
        
		$holidays = "<br/>".$Holidays_array[$date];
        //祝日が見つかれば$holidaysに入れておく
		return $holidays; 
	}
}   

//前月・次月リンクが選択された場合は、GETパラメーターから年月を取得
if(isset($_GET['ym'])){ 
    $ym = $_GET['ym'];
}else{
    //今月の年月を表示
    $ym = date('Y-m');
}
 
//タイムスタンプ（どの時刻を基準にするか）を作成し、フォーマットをチェックする
//strtotime('Y-m-01')
$timestamp = strtotime($ym . '-01'); 
if($timestamp === false){//エラー対策として形式チェックを追加
    //falseが返ってきた時は、現在の年月・タイムスタンプを取得
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
 
//今月の日付　フォーマット　例）2020-10-2
$today = date('Y-m-j');
 
//カレンダーのタイトルを作成　例）2020年10月
$html_title = date('Y年n月', $timestamp);//date(表示する内容,基準)
 
//前月・次月の年月を取得
//strtotime(,基準)
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));
 
//該当月の日数を取得
$day_count = date('t', $timestamp);
 
//１日が何曜日か
$youbi = date('w', $timestamp);
 
//カレンダー作成の準備
$weeks = [];
$week = '';
 
//第１週目：空のセルを追加
//str_repeat(文字列, 反復回数)
$week .= str_repeat('<td></td>', $youbi);
 
for($day = 1; $day <= $day_count; $day++, $youbi++){
    
    $date = $ym . '-' . $day; //2020-00-00

    $reservation = reservation(date("Y-m-d",strtotime($date)),$reservation_array);
    $Holidays_day = display_to_Holidays(date("Y-m-d",strtotime($date)),$Holidays_array);
    if($login_mail != NULL){
        $reseryotei = reseryotei(date("Y-m-d",strtotime($date)),$reseryotei_array);
        $reseryotei_owari = reseryotei_owari(date("Y-m-d",strtotime($date)),$reseryotei_owari_array);
    }
    
    $tag = '<td class="%value%">'. $day;
    $value = "";
    
    //ログインされている場合
        if($today == $date){
            //$week .= '<td class="today">' . $day;//今日の場合はclassにtodayをつける
            $value .= "today ";
        }if(display_to_Holidays(date("Y-m-d",strtotime($date)),$Holidays_array)){
            //もしその日に祝日が存在していたら
            //その日が祝日の場合は祝日名を追加しclassにholidayを追加する
            //$week .= '<td class="holiday">' . $day . $Holidays_day;
            $tag .= $Holidays_day;
            $value .="holiday ";
        }if(reservation(date("Y-m-d",strtotime($date)),$reservation_array)){
            $link1 = '<a href="event.php?date=' .$reservation. '">' . $reservation . '</a>';
            //$week .= '<td>' . $day ."<br/>". $link1;
            $tag .="<br/>". $link1;
        }if($login_mail != NULL){
            if(reseryotei(date("Y-m-d",strtotime($date)),$reseryotei_array)){
            $link2 = '<a href="yotei.php?date=' .$reseryotei. '">' . $reseryotei . '</a>';
            //$week .= '<td>' . $day ."<br/>". $link2;
            $tag .= "<br/>". $link2;
            }if(reseryotei_owari(date("Y-m-d",strtotime($date)),$reseryotei_owari_array)){
            $link3 = '<a href="yotei.php?date=' .$reseryotei_owari. '">' . $reseryotei_owari . '</a>';
            //$week .= '<td>' . $day ."<br/>". $link2;
            $tag .= "<br/>". $link3;
            }
        }
    $tag = str_replace("%value%", $value, $tag);
    $tag .='</td>';
    $week .= $tag;
    
    $week .= '</td>';
    
    if($youbi % 7 == 6 || $day == $day_count){//週終わり、月終わりの場合
        //%は余りを求める、||はまたは
        //土曜日を取得
        
        if($day == $day_count){//月の最終日、空セルを追加
            $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
        }
        
        $weeks[] = '<tr>' . $week . '</tr>'; //weeks配列にtrと$weekを追加
        
        $week = '';//weekをリセット
    }
}



?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TORカレンダー_ポートフォリオ</title>
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
            <div class = "main-container">
                <div class = "left">
                    <h3>東京ディズニーリゾート</h3>
                    <br>
                    ～情報～<br>
                    現在のディズニーリゾートでの閑散期は
                    1月・6月・7月となっております。<br>
                    繁忙期は3月・8月が一番多く、
                    12月や2月後半も混雑しています。<br>
                    日にちによってチケットの販売価格が異なりますので、
                    下のリンクからチケットの金額等ご確認ください。
                    <br>
                    <p>リンク</p>
                    <a href = "https://www.tokyodisneyresort.jp/top.html" target="_blank" rel="noopener">公式サイトはコチラ</a>
                </div>
                <div class = "right">
                    <div class="container">
                        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>日</th>
                                <th>月</th>
                                <th>火</th>
                                <th>水</th>
                                <th>木</th>
                                <th>金</th>
                                <th>土</th>
                            </tr>
                            <?php
                            foreach ($weeks as $week) {
                                echo $week;
                            }
                            ?>
                        </table>
                    </div>
                </div>
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
                <div class = "left">
                    <h3>東京ディズニーリゾート</h3>
                    <br>
                    <h2>～情報～</h2><br>
                    現在のディズニーリゾートでの閑散期は
                    1月・6月・7月となっております。<br>
                    繁忙期は3月・8月が一番多く、
                    12月や2月後半も混雑しています。<br>
                    日にちによってチケットの販売価格が異なりますので、
                    下のリンクからチケットの金額等ご確認ください。
                    <br>
                    <h2>リンク</h2>
                    <a href = "https://www.tokyodisneyresort.jp/top.html" target="_blank" rel="noopener">公式サイトはコチラ</a>
                    <br>
                    <h3>予定入力する場合は<br><a href = "http://localhost/kadai/schedule.php">コチラ</a></h3>
                </div>
                <div class = "right">
                    <div class="container">
                    <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>日</th>
                                <th>月</th>
                                <th>火</th>
                                <th>水</th>
                                <th>木</th>
                                <th>金</th>
                                <th>土</th>
                            </tr>
                            <?php
                            foreach ($weeks as $week) {
                            echo $week;
                            }
                            ?>
                        </table>
                    </div>
                </div>
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
        <script type="text/javascript" src="regist_check.js"></script>
    </body>
</html>