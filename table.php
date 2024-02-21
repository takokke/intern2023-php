<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<p><a href='/login' >ログインしていません</a></p>";
} else {
   // トークン作成
   $csrf_token = bin2hex(random_bytes(32));

   // 生成したトークンをセッションに保存
   $_SESSION['csrf_token'] = $csrf_token;

   echo "<p>ようこそ、$_SESSION[user_name]<p/>";
   echo "<p><a href='http://192.168.64.5/logout'>ログアウトはこちら</a></p>";
   echo "<h2>コメント投稿</h2>";
   echo "<form action='/' method='post' >";
   echo "<input type='hidden' name='csrf_token' value='$_SESSION[csrf_token])'>";
   echo "<div><textarea name='comment_text' rows='5' cols='40' placeholder='コメントを入力してください'></textarea></div>";
   echo "<div><input type='submit' value='投稿'></div>";
   echo "</form>";
}
 


$mysqli = new mysqli('localhost', 'takumi', 'brightech', 'test');
if($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset('utf8');
}

$sql = "SELECT u.id, u.user_name, c.text FROM trx_comments AS `c` JOIN trx_users AS `u` ON  u.id = c.user_id ORDER BY c.id;";
$result = $mysqli->query($sql);

// 切断
$mysqli->close();
echo "<table>\n";
echo "<tr><th>ID</th><th>ユーザ名</th><th>コメント</th></tr>\n";
while($row = $result->fetch_assoc() ){
    echo "<tr>\n";
    echo "<td>{$row['id']}</td>\n";
    echo "<td>{$row['user_name']}</td>\n";
    echo "<td>{$row['text']}</td>\n";
    echo "</tr>\n";
}
echo "</table>";
