<?php
session_start();

require_once('./../../config.php');

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
//var_dump($result);
?>
<?php

$csv;
for($i = 0; $i <= sizeof($result); $i++){
        $csv .= 
            $result[$i]['startTime'].','
            .$result[$i]['endTime'].','
            .$result[$i]['breakTime'].','
            .'=INDIRECT(("E"&(ROW())))-INDIRECT(("D"&(ROW())))-INDIRECT(("F"&(ROW())))'.','
            .$result[$i]['workPlace'].','
            .$result[$i]['work']."\r\n";
}
$fileName = "file.csv";
   header('Content-Type: text/plain');
   header('Content-Disposition: attachment; filename='.$fileName);
   echo mb_convert_encoding($csv, "SJIS", "UTF-8");  //←UTF-8のままで良ければ不要です。
   exit;
?>