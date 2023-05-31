<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Profile_Header.css')); ?>">
</head>
<body>
    <div class="prof_header">
        <div class="prof_wrap">
            <div>
                <a href="<?php echo e(route('topLink')); ?>">Cook Beginers Recipe</a>
            </div>
            <div class="right">
                <div class="status">
                    <img>
                    <div>ログイン中</div>
                </div>
            </div>
            <div class="profile">
                <a href="<?php echo e(route('profileLink')); ?>">プロフィール</a>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/Profile_Header.blade.php ENDPATH**/ ?>