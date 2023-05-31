<?php

//get
$nickname = session('nickname');
$filename = session('filename');
$filepath = session('filepath');

//post
$error = session('error');
$name = session('name');
$email = session('email');

?>

<?php
// require_once(ROOT_PATH .'Controllers/LoginController.php');

// $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
// $nickname = substr(str_shuffle($str), 0, 8);

// $errors = [];
// if(isset($_POST['submit'])){
//     //氏名
//     if (empty($_POST['name'])) {
//         $errors['name'] = '氏名は必須入力です。';
//     } elseif (10 < mb_strlen($_POST['name'])) {
//         $errors['name'] = '10文字以内で入力してください';
//     }

//     //メールアドレス
//     if (empty($_POST['email'])) {
//         $errors['email'] = 'メールアドレスは必須入力です。';
//     } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//         $errors['email'] = 'メールアドレスは正しくご入力ください。';
//     }

//     //パスワード
//     if (empty($_POST['password'])) {
//         $errors['password'] = 'パスワードは必須入力です。';
//     } elseif (5 > mb_strlen($_POST['password'])) {
//         $errors['password'] = '6文字以上で入力してください。';
//     }

//     //エラーがなかった場合の処理
//     // if (count($errors) == 0) {

//     //     $user = new LoginController();
//     //     $params = $user->newUser();

//     //     $filename = 'noimage.png';
//     //     $filepath = 'Profile_images/noimage.png';
//     //     $params = $user->newUserImage($filename,$filepath);


//     //     if(isset($_SESSION)){
//     //         session_destroy();
//     //     }
//     //     header('Location:Register_complete.php');
//     // }
//     // $_SESSION['name'] = $_POST['name'];
//     // $_SESSION['email'] = $_POST['email'];
// }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Top_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Register.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/footer.css')); ?>">
</head>
<body>
    <?php echo $__env->make('Top_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <div class="register_outline">
            <h2>新規登録フォーム</h2>
            <p><span class="red">*</span>は必須項目となります。</p> 
            <?php if(isset($error)): ?><?php $__currentLoopData = $error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p style="color: red;"><?php echo e($err); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <form class="register" method="POST" action="/Register">
                <?php echo csrf_field(); ?>
                <dl>
                    <dt>氏名<span class="red">*</dt>
                    <dd>
                        <input type="text" name="name" id="fullname" value="<?php if(isset($name)){echo $name;}?>" placeholder="山田太郎">
                    </dd>
                    <dt>メールアドレス<span class="red">*</span></dt>
                    <dd>
                        <input type="email" name="email" id="email" value="<?php if(isset($email)){echo $email;}?>" placeholder="test@test.co.jp">
                    </dd>
                    <dt>パスワード<span class="red">*</span></dt>
                    <dd>
                        <input type="password" name="password" id="password" value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];} ?>" placeholder="5文字以上でご記入ください">
                    </dd>
                    <dt>パスワード確認<span class="red">*</span></dt>
                    <dd>
                        <input type="password" name="conf_password" id="conf_password" placeholder="5文字以上でご記入ください">
                    </dd>
                </dl>
                <dd class="button">
                    <button type="submit" name="submit" id="submit">送  信</button>
                </dd>
                <input type="hidden" name="nickname" id="nickname" value="<?php echo $nickname; ?>">
                <input type="hidden" name="filename" id="filename" value="<?php echo $filename; ?>">
                <input type="hidden" name="filepath" id="filepath" value="<?php echo $filepath; ?>">
            </form>
        </div>
    </div>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//Register.blade.php ENDPATH**/ ?>