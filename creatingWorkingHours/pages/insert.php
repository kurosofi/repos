<?php
session_start();

require_once('./../../config.php');
//ここでデータを登録する
//var_dump($_REQUEST);
//echo $_REQUEST['today'];

function createSQL(){
	$sql ='
		INSERT INTO `u123244888_work`.`creatingWorkingHours` (
		`today`,
		`week`,
		`startTime`,
		`endTime`,
		`breakTime`,
		`workPlace`,
		`work`
		)
		VALUES (
		:today, :week, :startTime, :endTime, :breakTime, :workPlace, :work
		)';
	return $sql;
}

$result;
try{
	require_once('./../../db.php');
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');
    $sth;
    if('update' === hs($_REQUEST['conditions'])){
    	$sth = $dbh->prepare('DELETE FROM `u123244888_work`.`creatingWorkingHours` WHERE `creatingWorkingHours`.`today` = :today');
	    $sth->bindValue(':today',hs($_REQUEST['today']), PDO::PARAM_INT);
	    $sth->execute();
	    $sth ='';
    }
    $sth = $dbh->prepare(createSQL());
    $sth->bindValue(':today',hs($_REQUEST['today']), PDO::PARAM_INT);
    $sth->bindValue(':week',hs($_REQUEST['week']), PDO::PARAM_STR);
    $sth->bindValue(':startTime',hs($_REQUEST['startTime']), PDO::PARAM_STR);
    $sth->bindValue(':endTime',hs($_REQUEST['endTime']), PDO::PARAM_STR);
    $sth->bindValue(':breakTime',hs($_REQUEST['breakTime']), PDO::PARAM_STR);
    $sth->bindValue(':workPlace',hs($_REQUEST['workPlace']), PDO::PARAM_STR);
    $sth->bindValue(':work',hs($_REQUEST['work']), PDO::PARAM_STR);
    $sth->execute();
	header('Location: http://kurosofi.esy.es/creatingWorkingHours/pages/sag.php');
	exit;
}catch (PDOException $e){
    echo ('Error:'.$e->getMessage());
    die();
}
?>