<?php
session_start();

if (!isset($_SESSION['form'])) {
    header('Location: index.php');
    exit();
} else {
    $post = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'test@example.com';
    $from = $post['email'];
    $subject = 'お問い合わせが届きました';
    $body = <<<EOT
名前： {$post['name']}
メールアドレス： {$post['email']}
内容：
{$post['contact']}
EOT;
    // var_dump($body);
    // exit();

    // mb_send_mail($to, $subject, $body, "From: {$from}");

    unset($_SESSION['form']);
    header('Location: thanks.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>送信内容確認</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h4 class="py-4 text-center">確認画面</h4>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-offset-2">
                        <label for="inputName">お名前</label>
                    </div>
                    <div class="col-md-8 col-offset-2">
                        <p><?php echo htmlspecialchars($post['name']); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-offset-2">
                        <label for="inputEmail">メールアドレス</label>
                    </div>
                    <div class="col-md-8 col-offset-2">
                        <p><?php echo htmlspecialchars($post['email']); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-offset-2">
                        <label for="inputContent">お問い合わせ内容</label>
                    </div>
                    <div class="col-md-8 col-offset-2">
                        <p><?php echo nl2br(htmlspecialchars($post['contact'])); ?></p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-offset-2">
                    <a href="index.php" class="btn btn-primary rounded-0">戻る</a>
                    <button type="submit" class="btn btn-primary rounded-0">送信する</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>