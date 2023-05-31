<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Level_Recipe.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Top_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Level_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/footer.css')); ?>">
</head>
<body>
    <?php echo $__env->make('Top_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Level_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main_top">
        <div class="wrap">
            <h2>難易度レベル:<?php echo $level ?></h2>

            <?php $__currentLoopData = $recipeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $recipe_id = $article->recipe_id ?>
                <div class="article_outline">
                    <div class="article">
                        <a href="<?php echo e(route('recipeDetailLink',$recipe_id)); ?>">
                            <img class="comp_img" src="<?php echo e(asset($article->comp_img)); ?>">
                        </a>
                        <div class="article_right">
                            <h3><li><a href="<?php echo e(route('recipeDetailLink',$recipe_id)); ?>"><?php echo $article->title ?></li></a></h3>
                            <div class="rightdown">
                                <div class="downleft">
                                    <img src="<?php echo e(asset($article->user_img)); ?>">
                                    <p>投稿者:<?php echo $article->nickname ?></p>
                                </div>
                                <div class="comment">
                                    <li>
                                        <a href="<?php echo e(route('recipeDetailLink',$recipe_id)); ?>">
                                            <?php echo $article->comment ?>
                                        </a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//Level_Recipe.blade.php ENDPATH**/ ?>