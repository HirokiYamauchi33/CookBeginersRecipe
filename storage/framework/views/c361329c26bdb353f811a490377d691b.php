

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/admin_contributelist.css')); ?>">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿一覧</h2>
                <?php $__currentLoopData = $recipeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $recipe_id = $article->recipe_id ?>
                    <div class="article_outline">
                        <div class="article">
                                <img class="comp_img" src="<?php echo $article->comp_img ?>">
                            <div class="article_right">
                                <div class="rightup">
                                    <h3><?php echo $article->title ?></h3>
                                </div>
                                <div class="comment"><?php echo $article->comment ?></div>
                            </div>
                        </div> 
                        <div class="button">
                            <button>
                                <a href="<?php echo e(route('adminDeleteRecipeLink',$recipe_id)); ?>" onclick="return confirm('本当に削除しても宜しいですか？')">削除</a>
                            </button>
                        </div>
                    </div>    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//admin_contributelist.blade.php ENDPATH**/ ?>