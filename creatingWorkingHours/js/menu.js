var list = [
    ['作業報告書','/pages/sag.php'],
    ['CSV作成','/pages/createcsv.php'],
    ['交通費請求書','/pages/kou.php'],
    ['ログアウト','/pages/logout.php']
];
for (var i = 0; i <= list.length - 1; i++) {
    document.write('<a href="' + sitePath + list[i][1] + '">' + list[i][0] + '</a><br>');
}