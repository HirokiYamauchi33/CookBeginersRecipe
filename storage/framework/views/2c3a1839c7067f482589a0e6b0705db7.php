<?php
if(isset($msg)){
    var_dump($msg);
};

$greeting_err = session('greeting_error');
$name_err = session('name_error');
$nickname_err = session('nickname_error');
$email_err = session('email_error');
$pass_err = session('password_error');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo e(asset('/js/UploadImage.js')); ?>" type="text/javascript" defer></script>
    <link rel="stylesheet" href="<?php echo e(asset('/css/ProfileEdit.css')); ?>">
</head>
<body>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <form class="prof_edit" action="/ProfileEdit" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="prof_outline">
                    <h2>プロフィール編集</h2>
                    <div class="prof_top">
                        <img id="picture" src="<?php echo $users->prof_file_path ?>">
                        <div class="upload" class="top_picture">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                            <input id="image" multiple name="file" type="file" accept="image/*">
                        </div>
                    </div>
                    <div>
                        <h2>一言コメント</h2>
                        <?php if(isset($greeting_err)): ?> <?php $__currentLoopData = $greeting_err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="red"><?php echo e($err); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <textarea class="greeting" name="greeting"><?php echo $users->greeting ?></textarea>
                    </div>
                        <dl>
                            <dt>氏名</dt>
                            <?php if(isset($name_err)): ?> <?php $__currentLoopData = $name_err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="red"><?php echo e($err); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <dd>
                                <input type="text" name="name" id="name" placeholder="山田太郎" value="<?php echo $users->name ?>">
                            </dd>
                            <dt>ニックネーム</dt>
                            <?php if(isset($nickname_err)): ?> <?php $__currentLoopData = $nickname_err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="red"><?php echo e($err); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <dd>
                                <input type="text" name="nickname" id="nickname" placeholder="ニックネーム" value="<?php echo $users->nickname ?>">
                            </dd>
                            <dt>メールアドレス</span></dt>
                            <?php if(isset($email_err)): ?> <?php $__currentLoopData = $email_err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="red"><?php echo e($err); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <dd>
                                <input type="text" name="email" id="email" placeholder="test@test.co.jp">
                            </dd>
                            <dt>パスワード</span></dt>
                            <?php if(isset($pass_err)): ?> <?php $__currentLoopData = $pass_err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="red"><?php echo e($err); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <dd>
                                <input type="text" name="password" id="password" placeholder="5文字以上でご記入ください">
                            </dd>
                        </dl>
                        <dd class="button">
                            <button type="submit" name="submit" id="submit">送  信</button>
                        </dd>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/ProfileEdit.blade.php ENDPATH**/ ?>