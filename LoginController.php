<?php
  session_start();
  echo $_SESSION['user_id'];
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
    header('Location: http://192.168.64.5/table');
    // exit();
  } else {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
         // $_POST["username"]も$_POST["passwprd"]も入力されている
        // 値を受け取る
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
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_id'] = $id;
                $stmt->close();
                $mysqli->close();
                header('Location: http://192.168.64.5/table');
            } else {
                header('Location: http://192.168.64.5/login');
                $stmt->close();
            }
        };
    }
  }
  $mysqli->close();
