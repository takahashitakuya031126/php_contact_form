<?php
session_start();
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if ($post['name'] === '') {
        $error['name'] = 'blank';
    }
    if ($post['email'] === '') {
        $error['email'] = 'blank';
    } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email']= 'email';
    }
    if ($post['contact'] === '') {
        $error['contact'] = 'blank';
    }

    if (count($error) === 0) {
        $_SESSION['form'] = $post;
        header('Location: confirm.php');
        exit();
    }
} else {
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form action="" method="POST" novalidate>
            <h4 class="py-4 text-center">お問い合わせ</h4>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-offset-2">
                        <label for="inputName">お名前（必須）</label>
                    </div>
                    <div class="col-md-8 col-offset-2">
                        <input type="text" name="name" id="inputName" class="form-control rounded-0" value="<?php echo htmlspecialchars($post['name']); ?>" required autofocus>
                        <?php if ($error['name'] === 'blank'): ?>
                            <p class="error_msg text-danger">※お名前をご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-offset-2">
                        <label for="inputEmail">メールアドレス（必須）</label>
                    </div>
                    <div class="col-md-8 col-offset-2">
                        <input type="email" name="email" id="inputEmail" class="form-control rounded-0" value="<?php echo htmlspecialchars($post['email']); ?>" required>
                        <?php if ($error['email'] === 'blank'): ?>
                            <p class="error_msg text-danger">※メールアドレスをご記入下さい</p>
                        <?php endif; ?>
                        <?php if ($error['email'] === 'email'): ?>
                            <p class="error_msg text-danger">※メールアドレスを正しくご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-offset-2">
                        <label for="inputContent">お問い合わせ内容（必須）</label>
                    </div>
                    <div class="col-md-8 col-offset-2">
                        <textarea name="contact" id="inputContent" rows="10" class="form-control rounded-0" required><?php echo htmlspecialchars($post['contact']); ?></textarea>
                        <?php if ($error['contact'] === 'blank'): ?>
                            <p class="error_msg text-danger">※お問い合わせ内容をご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-offset-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-0">確認画面へ</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>