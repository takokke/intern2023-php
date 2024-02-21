<?php

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
    header('Location: http://192.168.64.5/newUser');

}