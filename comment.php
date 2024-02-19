<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  //ログインしていないときは処理されたくない
  echo "Bad Request";
  exit();
}

// 接続
$mysqli = new mysqli('localhost', 'takumi', 'brightech', 'test');

//接続状況の確認
if($mysqli->connect_error){
  echo $mysqli->connect_error;
  exit();
}

/**
 * 課題：trx_commentsにPOSTされたコメントとログインしているユーザのidをINSERTで追加する処理を書いてください
 */
if (isset($_POST["comment_text"]) && !empty($_POST["comment_text"])) {

}


//リダイレクト（table.phpにリダイレクトすると自然な流れになると思います）
header('Location: http://192.168.64.6/table.php');