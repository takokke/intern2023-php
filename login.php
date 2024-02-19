<?php
  session_start();
  //MySQLに接続
  $mysqli = new mysqli('localhost', 'takumi', 'brightech', 'test');
  if($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
  } else {
    $mysqli->set_charset('utf8');
  }

  if(isset($_SESSION['user_id'])) {
    // SESSION[user_id]に値入っていればログインしたとみなす
    echo "<div>$_SESSION[user_name]さんは現在ログインしています</div>";
    echo "<div><a href='logout.php'>ログアウトページへ</a></div>";
    exit();
  } else {
    if (isset($_POST["username"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
        // 入力フォームから受け取る
        $username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
        $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
        // パスワードをハッシュ化
        $password_hash = hash("sha256", $password);

        $stmt = $mysqli->prepare("SELECT * FROM trx_users WHERE `user_name`=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $user_name, $db_password);
        while ($stmt->fetch()) {
            if ($db_password == $password_hash) {
                echo 'ログインしました';
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_id'] = $id;
                echo "<div><a href='logout.php'>ログアウトはこちら</a></div>";
            } else {
                echo "ユーザ名かパスワードが違います";
            }
        };
        $stmt->close();
    }
  }
  $mysqli->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログイン</h2>
		<form action="login.php" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />
		</form>
	</body>
</html>