<?php
session_start();
if (isset($_POST["logout"])) {
    if(isset($_SESSION['user_id'])) {
        $_SESSION = array();
        echo "<p>ログアウトしました</p>";
        echo "<p><a href='login.php'>ログインはこちら</a></p>";
        session_destroy();
		header('Location: http://192.168.64.6/table.php');
    } else {
        echo "<a href='login.php'>ログインしてください</a>";
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログアウト</h2>
		<form action="logout.php" method="post">
		  <button type="submit" name="logout" value="send">ログアウト</button>
		</form>
	</body>
</html>