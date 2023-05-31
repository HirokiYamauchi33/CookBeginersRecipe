<?php
// require_once(ROOT_PATH .'Controllers/UploadController.php');
// $upload = new UploadController();

// $getTejun = $recipeController->getTejun($recipe_id);

//$countは手順コメントの数
// $count = count($getTejun);
//ok
// var_dump($getFile);

$file = [];
foreach($getFile as $f){
$data = $f->file_path;
array_push($file,$data);
}

$tejun =[];
foreach($getTejun as $t){
$data = $t->proce_com;
array_push($tejun,$data);
}

// $getFile = $recipeController->getFile2($recipe_id,$count);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Top_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Level_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/RecipeDetail.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/footer.css')); ?>">
</head>
<body>
<?php echo $__env->make('Top_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Level_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="detail">
        <div class="wrap">
            <div class="inner">

                <div class="section1">
                <?php $__currentLoopData = $getRecipe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h2><?php echo $section1->title ?></h2>
                    <div class="flex">
                        <img class="comp_img" src="<?php echo e(asset($section1->comp_img)); ?>">
                        <div class="section1_right">
                            <div class="flex">
                                <img class="user_img" src="<?php echo e(asset($section1->user_img)); ?>">
                                <p><?php echo $section1->nickname ?></p>
                            </div>
                            <p class="tk">投稿者からのコメント</p>
                            <p class="comment"><?php echo $section1->comment ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="section2">
                    <h3>材料</h3>
                    <!-- foreach -->
                    <?php $__currentLoopData = $getMaterial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="between">
                        <p><?php echo $section2->material ?></p>
                        <p><?php echo $section2->quanity ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="section3">
                    <h3>作り方</h3>
                    <div class="tejun_grid">
                        <?php for($i = 0; $i< $count; $i++) { ?>
                        <div>
                            <h3><?php echo $i+1 ?></h3>
                            <div class="flex">
                                <img  src="<?php echo e(asset( $file[$i])); ?>">
                                <p><?php echo $tejun[$i] ?></p>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
                

            </div>
        </div>
    </div>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//RecipeDetail.blade.php ENDPATH**/ ?>