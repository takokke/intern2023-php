<?php
session_start();
if (isset($_POST["logout"])) {
    if(isset($_SESSION['user_id'])) {
        $_SESSION = array();
        session_destroy();
		header('Location: http://192.168.64.5/table');
    } else {
        echo "<a href='/login'>ログインしていません</a>";
    }
}