<?php
session_start();

require_once('./../../config.php');
require_once('./../../sampleProgram/showWeek.php');
$title ='勤務時間編集ページ';

if($_SESSION['flag']){

    $min = date("1");
    $max = date("t");
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- IE8+に対して「IE=edge」と指定することで、利用できる最も互換性の高い最新のエンジンを使用するよう指示できます
         参考: https://www.modern.ie/en-us/performance/how-to-use-x-ua-compatible -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $title ?>">
    <meta name="author" content="Kurosofi">
    <!-- モバイル端末への対応、ページをビューポートの幅に合わせてレンダリング（Android, iOS6以降）
         ズームを許可しない設定「user-scalable=no」は加えない -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
     
    <!-- スタイルシートはできるだけ早くレンダリングされるため、HTMLドキュメントの上の方に記述
         href属性にスタイルシートファイルのURIを記述 -->
    <link rel="stylesheet" href="<?php echo $sitePath; ?>/css/common.css">
    <script type="text/javascript" src="<?php echo $sitePath; ?>/js/calender.js"></script>
    <!-- href属性にファビコンファイルのURIを記述 -->
    <link rel="shortcut icon" href="<?php echo $fabicon; ?>">
     
    <!-- コメントアウトしてあるコードは、iOS/Android用のアイコン指定 -->
    <!--
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="196x196" href="">
    <link rel="apple-touch-icon" sizes="152x152" href="">
    -->
     
    <!-- スクリプトでブロッキングを起こさないものはここに記述
         可能であれば「async（文書の読み込みが完了した時点でスクリプトを実行）」を使用
         Example: <script src="" async>
    </script> -->
  </head>
  <body>
    <span>
      ようこそ<?php echo $_SESSION['name'] ?>さん
    </span>
    <div>
	    <script type="text/javascript">
	      var sitePath = "<?php echo $sitePath; ?>";
	      var min = "<?php echo $min; ?>";
	      var max = "<?php echo $max; ?>";
	    </script>
	    <script type="text/javascript" src="<?php echo $sitePath; ?>/js/menu.js"></script>
    </div>
    <div id="contents">
    <?php
	
	$result;
	try{
		require_once('./../../db.php');
	    $dbh = new PDO($dsn, $user, $password);
	    $dbh->query('SET NAMES utf8');
	    $sth = $dbh->prepare('SELECT * FROM creatingWorkingHours ORDER BY today ASC');
	    $sth->execute();
	    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $e){
	    echo ('Error:'.$e->getMessage());
	    die();
	}
	/*
	var_dump(sizeof($result));
	var_dump(count($result));
	*/
	//var_dump($result);

	require_once('./../../sampleProgram/createTable.php');
	?>
	<div class="left">
		<?php echo calendar();?>
	</div>
	<div class="left">
			<?php
			for($i = $min; $i <= $max; $i++){
				?>
				<form action="<?php echo $sitePath; ?>/pages/insert.php"　method="post">
				<div id="lineID_<?php echo $i; ?>" class="disp">
				<select name="conditions">
				<?php
				if(is_null($result[$i-1]['today'])){ ?>
					<option value="insert">新規</option>
					<option value="update">更新</option>
				<?php }else{ ?>
					<option value="update">更新</option>
					<option value="insert">新規</option>
				<?php } ?>
				</select><br>
				<?php
				if(is_null($result[$i-1]['today'])){ ?>
					日付:<input type="text" name="today" size="4" maxlength="4" value="<?php echo hs($i); ?>"><br>
				<?php }else{ ?>
					日付:<input type="text" name="today" size="4" maxlength="4" value="<?php echo hs($result[$i-1]['today']); ?>"><br>
				<?php }
				if(is_null($result[$i-1]['week'])){ ?>
					曜日:<input type="text" name="week" size="4" maxlength="4" value="<?php echo hs($weekjp[date('w', mktime(0, 0, 0, $month, $i, $year))]); ?>"><br>
				<?php } else{ ?>
					曜日:<input type="text" name="week" size="4" maxlength="4" value="<?php echo hs($result[$i-1]['week']); ?>"><br>
				<?php }
				if(is_null($result[$i-1]['startTime'])){ ?>
					開始時間:<input type="text" name="startTime" size="10" maxlength="10" value="9:00"><br>
				<?php }else{ ?>
					開始時間:<input type="text" name="startTime" size="10" maxlength="10" value="<?php echo hs($result[$i-1]['startTime']); ?>"><br>
				<?php } 
				if(is_null($result[$i-1]['endTime'])){ ?>
					終了時間:<input type="text" name="endTime" size="10" maxlength="10" value="18:00"><br>
				<?php }else{ ?>
					終了時間:<input type="text" name="endTime" size="10" maxlength="10" value="<?php echo hs($result[$i-1]['endTime']); ?>"><br>
				<?php }
				if(is_null($result[$i-1]['breakTime'])){ ?>
					休憩時間:<input type="text" name="breakTime" size="10" maxlength="10" value="1:00"><br>
				<?php }else{ ?>
					休憩時間:<input type="text" name="breakTime" size="10" maxlength="10" value="<?php echo hs($result[$i-1]['breakTime']); ?>"><br>
				<?php } ?>
					作業時間:<input type="text" size="10" maxlength="10" placeholder="csvで取得"><br>
					作業場所:<input type="text" name="workPlace" size="10" maxlength="10" value="<?php echo hs($result[$i-1]['workPlace']); ?>"><br>
					作業内容:<input type="text" name="work" size="10" maxlength="10" value="<?php echo hs($result[$i-1]['work']); ?>"><br>
					<input type="submit" value="送信">
				</div>	
		</form>
			<?php
		}?>
	</div>
    </div>
  </body>
</html>
<?php
}else{
  header('Location: http://kurosofi.esy.es/creatingWorkingHours/pages/failures.php');
  exit;
}
?>