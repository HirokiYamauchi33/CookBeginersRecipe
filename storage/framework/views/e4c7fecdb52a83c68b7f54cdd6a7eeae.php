<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Profile.css')); ?>">
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <div class="prof_top">
                    <img class="img" src="<?php echo $user->prof_file_path ?>">
                    <div class="name">
                        <div>
                            <p><?php echo $user->nickname ?></p>
                        </div>
                        <div class="edit_button">
                            <a href="<?php echo e(route('profEditLink')); ?>">プロフィール編集</a>
                        </div>
                    </div>
                </div>
                <div class="prof_bottom">
                    <h3>コメント</h3>
                    <p><?php echo $user->greeting ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/Profile.blade.php ENDPATH**/ ?>