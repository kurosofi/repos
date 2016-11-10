<?php
session_start();

require_once('./../../config.php');
// セッション変数を全て解除する
$_SESSION = array();

// セッションを切断するにはセッションクッキーも削除する。
// Note: セッション情報だけでなくセッションを破壊する。
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// 最終的に、セッションを破壊する
session_destroy();


header('Location: http://kurosofi.esy.es/creatingWorkingHours/');
exit;
?>
