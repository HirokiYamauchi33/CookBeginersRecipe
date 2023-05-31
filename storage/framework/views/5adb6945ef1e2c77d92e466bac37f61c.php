
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Top_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Register_complete.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/footer.css')); ?>">
</head>
<body>
    <?php echo $__env->make('Top_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <div class="register_outline">
            <p >ログアウトしました。</p> 
            <div class="ok">
                <a href="<?php echo e(route('topLink')); ?>">トップページへ</a>
            </div>
        </div>
    </div>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//Logout.blade.php ENDPATH**/ ?>