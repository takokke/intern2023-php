<?php
// 接続（host_name, user_name, password, database_nameは作成済みのものを使用）
$mysqli = new mysqli('localhost', 'takumi', 'brightech', 'test');

//接続状況の確認
//接続状況の確認
if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset('utf8');
}

$sql = "INSERT INTO user VALUES (1,'aiueo','0123')";
$mysqli->query($sql);

// 切断
$mysqli->close();