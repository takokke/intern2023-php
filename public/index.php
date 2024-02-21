<?php

$route = [
    [
        'method' => 'GET',
        'url'=> '/newUser',
        'file'=> 'newUser.php',
    ],
    [
        'method' => 'POST',
        'url'=> '/sing_up',
        'file'=> 'SingUpController.php',
    ],
    [
        'method'=> 'GET',
        'url'=> '/login',
        'file'=> 'login.php',
    ],
    [
        'method'=> 'POST',
        'url'=> '/login',
        'file'=> 'LoginController.php',
    ],
    [
        'method'=> 'GET',
        'url'=> '/logout',
        'file'=> 'logout.php',
    ],
    [
        'method'=> 'POST',
        'url'=> '/logout',
        'file'=> 'LogoutController.php',
    ],
    [
        'method'=> 'GET',
        'url'=> '/table',
        'file'=> 'table.php',
    ],
    [
        'method'=> 'POST',
        'url'=> '/',
        'file'=> 'comment.php',
    ]
];

$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ルートの検索
$matched_route = null;
foreach ($route as $route_item) {
    if ($route_item['method'] === $request_method && $route_item['url'] === $request_uri) {
        $matched_route = $route_item;
        break;
    }
}

// マッチしたルートがあるかどうかを確認し、対応するファイルを含めるか404エラーを返す
if ($matched_route !== null) {
    include "../".$matched_route['file'];
} else {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
}