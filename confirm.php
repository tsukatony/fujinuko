<?php
session_start();

// 入力画面からのアクセスでなければ戻す
if (!isset($_SESSION["form"])) {
    header("Location: request.php");
    exit();
}
else {
    $post = $_SESSION["form"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // メールを送信する
    $to = "tsukatony@icloud.com";
    $from = $post["email"];
    $subject = "お問い合わせが届きました";
    $body = <<<EOT
名前: {$post["name"]}
ふりがな: {$post["kana"]}
メールアドレス: {$post["email"]}
内容: 
{$post["comment"]}
EOT;
    // var_dump($body);
    // exit();
    // mb_send_mail($to, $subject, $body, "From: {$from}");

    unset($_SESSION["form"]);
    header("Location: thanks.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>藤ぬこの部屋 - 話題リクエスト</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="script/script.js"></script>
    </head>
    <body class="home">
        <header>
            <h1>藤ぬこの部屋</h1>
            <nav class="nav">
                <ul class="inline">
                    <li><a href="index.html">ホーム</a></li>
                    <li><a href="">雑談</a></li>
                    <li><a href="request.php">話題リクエスト</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="inner">
                <h2>確認画面</h2>
                <div class="balloon1">
                    <div class="icon">
                        <img src="images/cat_mikeneko2.png">
                    </div>
                    以下の内容で送信します。<br>
                    再度、記述内容に不備がないかご確認ください。
                </div>
                <form action="" method="POST" novalidate>
                    <dl class="confirm">
                    <dt>お名前</dt>
                    <dd>
                        <p><?php echo htmlspecialchars($post["name"]); ?></p>
                    </dd>
                    <dt>ふりがな</dt>
                    <dd>
                        <p><?php echo htmlspecialchars($post["kana"]); ?></p>
                    </dd>
                        <dt>メールアドレス</dt>
                    <dd>
                        <p><?php echo htmlspecialchars($post["email"]); ?></p>
                    </dd>
                    <dt>話題の内容</dt>
                    <dd>
                        <p><?php echo nl2br(htmlspecialchars($post["comment"])); ?></p>
                    </dd>
                </dl>
                <div class="button">
                    <a href="request.php"><input type="submit" name="submit" value="戻る"></a>
                    <p class="submit"><input type="submit" name="submit" value="送信する"></p>
                </div>
                </form>
            </div>
        </main>
        <footer>
            <div class="sitemap">
                <h3>サイトマップ</h3>
                <a href="index.html">ホーム</a>
                <div class="submenu">
                    <p>雑談</p>
                    <div class="hidden">
                        <p><a href="">アニメ</a></p>
                        <p><a href="">その他</a></p>
                    </div>
                </div>
                <a href="request.php">話題リクエスト</a>
            </div>
            <div class="sidebar">
                <a href="">プライバシーポリシー</a>
                <p><small>&copy; 2022 藤ぬこの部屋</small></p>
            </div>
        </footer>
    </body>
</html>