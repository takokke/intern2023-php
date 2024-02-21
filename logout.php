<?php
session_start();
if(!isset($_SESSION['user_id'])) {
	echo "<p><a href='login.php'>ログインしていません</a></p>";
} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログアウト</h2>
		<form action="/logout" method="post">
		  <button type="submit" name="logout" value="send">ログアウト</button>
		</form>
	</body>
</html>