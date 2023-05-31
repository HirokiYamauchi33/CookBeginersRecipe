<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/admin_userlist.css')); ?>">
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>ユーザーリスト</h2>
                <p>ユーザーを削除しました。</p>
                <div class="ok">
                    <a href="<?php echo e(route('adminLink')); ?>">管理者画面へ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/admin_delete.blade.php ENDPATH**/ ?>