<?php
session_start();

require_once('./../config.php');
require_once('./../db.php');


//フラグ確認用
var_dump($_SESSION['flag']);

if($flag){
  header('Location: http://kurosofi.esy.es/creatingWorkingHours/pages/mypage.php');
  exit;
}else{
  header('Location: http://kurosofi.esy.es/creatingWorkingHours/pages/failures.php');
  exit;
}

?>