<?php
session_start();
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $post = filter_input_array(INPUT_POST, $_POST);

    // フォームの送信時にエラーチェックする
    if ($post["name"] === "") {
        $error["name"] = "blank";
    }
    if ($post["kana"] === "") {
        $error["kana"] = "blank";
    }
    if ($post["email"] === "") {
        $error["email"] = "blank";
    }
    else if (!filter_var($post["email"], FILTER_VALIDATE_EMAIL)) {
        $error["email"] = "email";
    }
    if ($post["comment"] === "") {
        $error["comment"] = "blank";
    }

    if (count($error) === 0) {
        // エラーがないので確認画面に移動する
        $_SESSION["form"] = $post;
        header("Location: confirm.php");
        exit();
    }
}
else {
    if (isset($_SESSION["form"])) {
        $post = $_SESSION["form"];
    }
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
                <h2>話題リクエスト</h2>
                <form action="" method="POST" novalidate>
                    <dl>
                        <dt>お名前<span class="must">*</span></dt>
                        <dd>
                            <input type="text" name="name" placeholder="藤ぬこ" value="<?php echo htmlspecialchars($post["name"]); ?>">
                            <?php if ($error["name"] === "blank"): ?>
                                <p class="errorMsg">*お名前をご記入ください</p>
                            <?php endif; ?>
                        </dd>
                        <dt>ふりがな<span class="must">*</span></dt>
                        <dd>
                            <input type="text" name="kana" placeholder="ふじぬこ" value="<?php echo htmlspecialchars($post["kana"]); ?>">
                            <?php if ($error["kana"] === "blank"): ?>
                                <p class="errorMsg">*ふりがなをご記入ください</p>
                            <?php endif; ?>
                        </dd>
                            <dt>メールアドレス<span class="must">*</span></dt>
                        <dd>
                            <input type="email" name="email" placeholder="fujinuko@yakitori.com" value="<?php echo htmlspecialchars($post["email"]); ?>">
                            <?php if ($error["email"] === "blank"): ?>
                                <p class="errorMsg">*メールアドレスをご記入ください</p>
                            <?php endif; ?>
                            <?php if ($error["email"] === "email"): ?>
                                <p class="errorMsg">*メールアドレスを正しくご記入ください</p>
                            <?php endif; ?>
                        </dd>
                        <dt>話題の内容<span class="must">*</span></dt>
                        <dd>
                            <textarea name="comment" cols="20" rows="5"><?php echo htmlspecialchars($post["comment"]); ?></textarea>
                            <?php if ($error["comment"] === "blank"): ?>
                                <p class="errorMsg">*リクエスト内容をご記入ください</p>
                            <?php endif; ?>
                        </dd>
                    </dl> 
                    <p class="submit"><input type="submit" name="submit" value="確認画面へ"></p>
                </form>
                <div class="balloon2">
                    <div class="icon">
                        <img src="images/bird_aoitori_bluebird.png">
                    </div>
                    話題の内容に困っているなら、<br>藤ぬこたちにちょっとした質問を送ってあげるといいかもね。
                </div>
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