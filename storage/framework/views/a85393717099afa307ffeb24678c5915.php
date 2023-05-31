<?php
$err = session('err');
$mailerr = session('mailmsg');
$pwerr = session('pwmsg');
$email = session('email');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Top_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Login.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/footer.css')); ?>">
</head>
<body>
<?php echo $__env->make('Top_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <div class="Login_outline">
            <h2>ログインフォーム</h2>
            <?php if(isset($err)): ?><?php $__currentLoopData = $err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p style="color: red;"><?php echo e($err); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if(isset($mailerr)): ?>
                <p style="color: red;"><?php echo e($mailerr); ?></p>
            <?php endif; ?>
            <?php if(isset($pwerr)): ?>
                <p style="color: red;"><?php echo e($pwerr); ?></p>
            <?php endif; ?>
            <form class="Login" action="/Login" method="POST">
                <?php echo csrf_field(); ?>
                <dl>
                    <dt>メールアドレス</span></dt>
                    <dd>
                        <input type="email" name="email" id="email" value="<?php if(isset($email)){echo $email;}?> ">
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
            <div class="passwordreset"><a href="<?php echo e(route('passResetLink')); ?>">パスワードを忘れた方はこちら</a></div>
        </div>
    </div>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//Login.blade.php ENDPATH**/ ?>