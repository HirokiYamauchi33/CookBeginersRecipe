<?php

// require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
// $recipeController = new SelectRecipeController();

// $newRecipeList = $recipeController->getNewRecipe();

// var_dump($_SESSION['login_user']['status']);

// var_dump($newRecipeList);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Top.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Top_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Level_Header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/footer.css')); ?>">
</head>
<body>
<?php echo $__env->make('Top_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Level_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main_top">
        <div class="wrap">
            <h2>最新の投稿</h2>
            <div class="article_outline">
            <?php $__currentLoopData = $newRecipeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $recipe_id = $article->recipe_id ?>
                <div class="article">
                    <a href="<?php echo e(route('recipeDetailLink',$recipe_id)); ?>">
                        <img class="comp_img" src="<?php echo $article->file_path ?>">
                    </a>
                    <div class="article_right">
                        <h3><li><a href="<?php echo e(route('recipeDetailLink',$recipe_id)); ?>"><?php echo $article->title ?></li></a></h3>
                        <div class="rightdown">
                            <div class="downleft">
                                <img src="<?php echo $article->prof_file_path ?>">
                                <p>投稿者:<?php echo $article->nickname ?></p>
                            </div>
                            <div class="comment"><li><a href="<?php echo e(route('recipeDetailLink',$recipe_id)); ?>"><?php echo $article->comment ?></li></a></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//index.blade.php ENDPATH**/ ?>