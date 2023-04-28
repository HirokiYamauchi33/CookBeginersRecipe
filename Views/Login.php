<?php
session_start();
require_once(ROOT_PATH .'Controllers/LoginController.php');
$err = $_SESSION;

//セッションを消す
$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include('Top_Header.php');?>
    <div class="wrap">
        <div class="Login_outline">
            <h2>ログインフォーム</h2>
            <?php if (isset($err['msg'])) : ?>
                <p style="color: red;"><?php echo $err['msg']; ?></p>
            <?php endif; ?>
            <?php if (isset($err['email'])) : ?>
                <p style="color: red;"><?php echo $err['email']; ?></p>
            <?php endif; ?>
            <?php if (isset($err['password'])) : ?>
                <p style="color: red;"><?php echo $err['password']; ?></p>
            <?php endif; ?>
            <form class="Login" action="./index.php" method="POST">
                <dl>
                    <dt>メールアドレス</span></dt>
                    <dd>
                        <input type="email" name="email" id="email">
                    </dd>
                    <dt>パスワード</span></dt>
                    <dd>
                        <input type="password" name="password" id="password">
                    </dd>
                </dl>
                <dd>
                    <p class="submit">
                        <input id="submit" type="submit" value="ログイン">
                    </p>
                </dd>
            </form>
            <div class="passwordreset"><a href="Password_Reset.php">パスワードを忘れた方はこちら</a></div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>