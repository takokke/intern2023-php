<?php
session_start();
if (isset($_SESSION['user_id'])) {
    echo "<h2>コメント投稿</h2>";
    echo "<form action='comment.php' method='post' >";
    echo "<div><textarea name='comment_text' rows='5' cols='40' placeholder='コメントを入力してください'></textarea></div>";
    echo "<div><input type='submit' value='投稿'></div>";
    echo "</form>";
} else {
    echo "<p>ログインしていません</p>";
}

$mysqli = new mysqli('localhost', 'takumi', 'brightech', 'test');
if($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset('utf8');
}

$sql = "SELECT c.id, u.user_name, c.text FROM trx_comments AS `c` JOIN trx_users AS `u` ON  u.id = c.user_id ORDER BY c.id;";
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
