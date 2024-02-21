<?php
  session_start();
  echo $_SESSION['user_id'];

  if(isset($_SESSION['user_id'])) {
    // SESSION[user_id]に値入っていればログインしたとみなす
    header('Location: http://192.168.64.5/table');

    exit();
  };

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログイン</h2>
		<form action="/login" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />
		</form>
	</body>
</html>
