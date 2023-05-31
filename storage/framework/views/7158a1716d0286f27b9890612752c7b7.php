<?php

$material = [];
$quanity = [];
$tejun = [];
$file = [];
foreach($getMaterial as $m){
    $data = $m->material;
    array_push($material,$data);
}
foreach($getMaterial as $q){
    $data = $q->quanity;
    array_push($quanity,$data);
}
foreach($getTejun as $t){
    $data = $t->proce_com;
    array_push($tejun,$data);
}
foreach($getFile as $f){
    $data = $f->file_path;
    array_push($file,$data);
}
?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Contribute_Edit.css')); ?>">
    <script src="<?php echo e(asset('/js/UploadImage.js')); ?>" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <form action="/Contribute_Edit" method="POST" enctype="multipart/form-data" class="upload_form"> 
                    <?php echo csrf_field(); ?>
                    <!-- <form method="POST" action="Contribute_complete.php"> -->
                    <?php $__currentLoopData = $getRecipe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="img_upload">
                            <div class="upload">
                                <h2>完成写真のアップロード</h2>
                                <div class="flex">
                                    <img id="picture" src="<?php echo e(asset($section1->comp_img)); ?>">
                                    <div>
                                        <!-- （2）input 属性はtype="file" と指定-->
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                        <input id="image" multiple name="file[]" type="file" accept="image/*" class="top_picture">
                                        <!-- 送信ボタン -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mid_info">
                                <div class="mid">
                                    <label for="title">タイトル:</label>
                                    <input type="title" name="title" value="<?php echo $section1->title ?>">
                                </div>
                                <div class="mid">
                                    <label for="comment">コメント:</label>
                                    <input type="comment" name="comment" value="<?php echo $section1->comment ?>">
                                </div>
                                <div class="mid">
                                    <label for="level">難易度:</label>
                                    <select name="level">
                                        <option value="<?php echo $section1->level ?>" selected>変更があれば選択してください</option>
                                        <option value="1">★☆☆☆☆</option>
                                        <option value="2">★★☆☆☆</option>
                                        <option value="3">★★★☆☆</option>
                                        <option value="4">★★★★☆</option>
                                        <option value="5">★★★★★</option>
                                    </select>
                                </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="material">
                        <h2>必要材料</h2>
                        <div class="grid">

                            <?php 
                                $count = count($getMaterial);
                                for($i = 0; $i< 12; $i++) { 
                            ?>

                            <div class="flex">
                                <h3><?php echo $i+1 ?></h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]" value="<?php if(isset($material[$i])){echo $material[$i];}?>">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]" value="<?php if(isset($quanity[$i])){echo $quanity[$i];}?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>

                    <div class="procedure">
                        <h2>手順</h2>
                            <div class="proce_grid">
                            <?php for($i = 0; $i< 6; $i++) { ?>
                                <div class="flex">
                                    <h3><?php echo $i+1 ?></h3>
                                    <div>
                                        <img class="proce_img" id="picture_2" src="<?php echo e(asset($file[$i])); ?>">
                                        <p>写真を選択</p>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                        <input id="image_2" multiple name="file[]" type="file" accept="image/*">
                                        <div class="down">
                                            <p>手順コメント</p>
                                            <textarea type="procedure" name="procedure[]"><?php if(isset($tejun[$i])){echo $tejun[$i];}?></textarea>
                                        </div>                                   
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                    </div>

                    <div>
                        <p class="submit">
                            <input id="submit" type="submit" value="上記内容を確認">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//Contribute_Edit.blade.php ENDPATH**/ ?>