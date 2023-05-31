<?php
session_start();

require_once(ROOT_PATH .'Controllers/LoginController.php');
$user = new LoginController();

$errors = [];
if(isset($_POST['submit'])){

    //メールアドレス
    if (empty($_POST['email'])) {
        $errors['email'] = 'メールアドレスは必須入力です。';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'メールアドレスは正しくご入力ください。';
    }

    //パスワード
    if (empty($_POST['password'])) {
        $errors['password'] = 'パスワードは必須入力です。';
    } elseif (5 > mb_strlen($_POST['password'])) {
        $errors['password'] = '6文字以上で入力してください。';
    }

    //エラーがなかった場合の処理
    if (count($errors) == 0) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $params = $user->updatePassword($password,$email);

        if(isset($_SESSION)){
            session_destroy();
        }

        header('Location:Password_Reset_complete.php');
    }
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Password_Reset.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include('Top_Header.php');?>
    <div class="wrap">
        <div class="register_outline">
            <h2>パスワード再設定フォーム</h2>
            <p><span class="red">*</span>は必須項目となります。</p> 
            <form class="register" method="POST" action="">
                <dl>
                    <dt>メールアドレス<span class="red">*<?php echo $errors['email'] ?? ""; ?></span></dt>
                    <dd>
                        <input type="text" name="email" id="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" placeholder="test@test.co.jp">
                    </dd>
                    <dt>新しいパスワード<span class="red">*<?php echo $errors['password'] ?? ""; ?></span></dt>
                    <dd>
                        <input type="text" name="password" id="password" value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];} ?>" placeholder="5文字以上でご記入ください">
                    </dd>
                </dl>
                <dd class="button">
                    <button type="submit" name="submit" id="submit">送  信</button>
                </dd>
            </form>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>