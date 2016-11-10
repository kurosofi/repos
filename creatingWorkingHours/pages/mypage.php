<?php
session_start();

require_once('./../../config.php');
$title ='マイページ';

if($_SESSION['flag']){
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
    </span><br>
    <script type="text/javascript">
      var sitePath = "<?php echo $sitePath; ?>";
    </script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>/js/menu.js"></script>
  </body>
</html>
<?php
}else{
  header('Location: http://kurosofi.esy.es/creatingWorkingHours/pages/failures.php');
  exit;
}
?>