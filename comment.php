<?php
session_start();

// 正式な入力画面(login.php)で生成されたcsrf_tokenと、POSTメソッドで送られるcsrf_tokenが等しくないか確認
if (!isset($_POST["csrf_token"]) && $_POST["csrf_token"] != $_SESSION['csrf_token']) {
  echo "不正なリクエストです";
  exit();
}

//ログインしていないときは処理されたくない
if (!isset($_SESSION['user_id'])) {
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

if (isset($_POST["comment_text"]) && !empty($_POST["comment_text"])) {
  $comment_text =  htmlspecialchars($_POST["comment_text"], ENT_QUOTES, "UTF-8");

  $stmt = $mysqli->prepare("INSERT INTO trx_comments (`user_id`, `text`) VALUES(?, ?)");
  $stmt->bind_param("is", $_SESSION["user_id"], $comment_text);

  // 実行
  $stmt->execute();

  // 切断
  $stmt->close();
}


$mysqli->close();

//リダイレクト（table.phpにリダイレクトすると自然な流れになると思います）
header('Location: http://192.168.64.6/table.php');
