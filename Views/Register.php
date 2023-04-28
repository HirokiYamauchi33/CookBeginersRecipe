<?php
session_start();

require_once(ROOT_PATH .'Controllers/LoginController.php');

$str = 'abcdefghijklmnopqrstuvwxyz0123456789';
$nickname = substr(str_shuffle($str), 0, 8);

$errors = [];
if(isset($_POST['submit'])){
    //氏名
    if (empty($_POST['name'])) {
        $errors['name'] = '氏名は必須入力です。';
    } elseif (10 < mb_strlen($_POST['name'])) {
        $errors['name'] = '10文字以内で入力してください';
    }

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

        $user = new LoginController();
        $params = $user->newUser();

        $filename = 'noimage.png';
        $filepath = 'Profile_images/noimage.png';
        $params = $user->newUserImage($filename,$filepath);


        if(isset($_SESSION)){
            session_destroy();
        }
        header('Location:Register_complete.php');
    }
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Register.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include('Top_Header.php');?>
    <div class="wrap">
        <div class="register_outline">
            <h2>新規登録フォーム</h2>
            <p><span class="red">*</span>は必須項目となります。</p> 
            <form class="register" method="POST" action="">
                <dl>
                    <dt>氏名<span class="red">*<?php echo $errors['name'] ?? ""; ?></dt>
                    <dd>
                        <input type="text" name="name" id="fullname" value="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>" placeholder="山田太郎">
                    </dd>
                    <dt>メールアドレス<span class="red">*<?php echo $errors['email'] ?? ""; ?></span></dt>
                    <dd>
                        <input type="text" name="email" id="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" placeholder="test@test.co.jp">
                    </dd>
                    <dt>パスワード<span class="red">*<?php echo $errors['password'] ?? ""; ?></span></dt>
                    <dd>
                        <input type="text" name="password" id="password" value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];} ?>" placeholder="5文字以上でご記入ください">
                    </dd>
                </dl>
                <dd class="button">
                    <button type="submit" name="submit" id="submit">送  信</button>
                </dd>
                <input type="hidden" name="nickname" id="nickname" value="<?php echo $nickname; ?>">
            </form>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>