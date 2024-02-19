<section>
    <form action="" method="post">
        <br>
        名前:<br>
        <input type="text" name="name" value=""><br>
        <br>
        パスワード:<br>
        <br>
        <input type="text" name="password" value=""><br>
        <input type="submit" value="登録">
    </form>
</section>
<?php

    $mysqli= new mysqli('localhost', 'takumi', 'brightech', 'test');
    if ($mysqli->connect_error) {
        echo $mysqli->connect_error;
        exit();
    }else{
        $mysqli->set_charset('utf8');
    }
    $num = htmlspecialchars($_POST['num'], ENT_QUOTES, "UTF-8");
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
    $pass = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");

    // プリペアドステートメント
    $stmt = $mysqli->prepare("INSERT INTO user VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $num, $name, $pass);

    //実行
    $stmt->execute();

    // 切断
    $stmt->close();
    $mysqli->close();
?>
