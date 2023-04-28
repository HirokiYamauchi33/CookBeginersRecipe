<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/PwReset.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include('Top_Header.php');?>
<div class="wrap">
    <div class="pwreset_outline">
        <h2>パスワード再設定</h2>
        <form class="pwreset">
            <dl>
                <dt>メールアドレス</span></dt>
                <dd>
                    <input type="text" name="password" id="password" placeholder="test@test.jp">
                </dd>
                <dt>新しいパスワード</span></dt>
                <dd>
                    <input type="text" name="password" id="password" placeholder="5文字以上でご記入ください">
                </dd>
            </dl>
            <dd class="button">
                <button type="submit" name="submit" id="submit">変更</button>
            </dd>
        </form>
    </div>
</div>
<?php include('footer.php');?>
</body>
</html>