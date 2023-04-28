<?php
session_start();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Register_complete.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include('Top_Header.php');?>
    <div class="wrap">
        <div class="register_outline">
            <h2>パスワード再設定フォーム</h2>
            <p>パスワードを変更しました!</p> 
            <div class="ok">
                <a href="Login.php">ログインページへ</a>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>