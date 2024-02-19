<?php
  /**
   * 課題１：mysqliを用いてMySQLに接続し，POSTで受け取ったデータをtrx_usersにINSERTする処理を書いてください
   * パスワードはハッシュ化する必要があるので，以下の$password_hashを用いてください
   */

    if (isset($_POST["username"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
        $mysqli= new mysqli('localhost', 'takumi', 'brightech', 'test');

        if ($mysqli->connect_error) {
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset('utf8');
        }


        $username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
        $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");

        // パスワードをハッシュ化
        $password_hash = hash("sha256", $password);

        // プリペードステイトメント
        $stmt = $mysqli->prepare("INSERT INTO trx_users (`user_name`, `password`) VALUES(?, ?)");
        $stmt->bind_param('ss', $username, $password_hash);

        //実行
        $stmt->execute();

        // 切断
        $stmt->close();
        $mysqli->close();
    }


   $password_hash = hash("sha256", $password);


?>

<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8">*:
	</head>
	<body>
		<h2>ユーザ追加</h2>
		<form action="newUser.php" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />
		</form>
	</body>
</html>