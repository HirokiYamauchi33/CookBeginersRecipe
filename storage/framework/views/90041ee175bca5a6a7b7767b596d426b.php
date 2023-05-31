<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/admin_userlist.css')); ?>">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>ユーザーリスト</h2>
                <table id="dbtable">
                    <thead>
                        <tr>
                            <th class="id">id</th> <th class="name">氏名</th> <th class="nickname">ニックネーム</th> <th class="email">メールアドレス</th> <th class="password">パスワード</th> <th class="rolr">ロール</th> <th class="operation">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $userdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $id = $userdata->id ?>
                        <tr>
                            <th><?php echo $id ?></th>
                            <th><?php echo $userdata->name ?></th>
                            <th><?php echo $userdata->nickname ?></th>
                            <th><?php echo $userdata->email ?></th>
                            <th><?php echo $userdata->password ?></th>
                            <th><?php echo $userdata->role ?></th>
                            <th class="delete">
                            <a class="delete_button" href="<?php echo e(route('adminDeleteLink',$id)); ?>" onclick="return confirm('削除してよろしいですか？')">削除</a>
                            </th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/admin_userlist.blade.php ENDPATH**/ ?>