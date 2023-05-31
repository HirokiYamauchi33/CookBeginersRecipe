<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/admin.css')); ?>">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>管理者画面</h2>
                <ul>
                    <li class="user"><a href="<?php echo e(route('adminUserListLink')); ?>">ユーザー一覧</a></li>
                    <li class="con_List"><a href="<?php echo e(route('admincontListLink')); ?>">投稿一覧</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//admin.blade.php ENDPATH**/ ?>