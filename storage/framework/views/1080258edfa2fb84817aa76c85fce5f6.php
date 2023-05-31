<?php
// require_once(ROOT_PATH .'Controllers/LoginController.php');
// $user = new LoginController();

// $id = $_SESSION['login_user']['id'];

// require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
// $recipeController = new SelectRecipeController();

// $userRecipeList = $recipeController->getRecipeUser($id);

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Contribute_List.css')); ?>">
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿レシピ一覧</h2>
                <?php $__currentLoopData = $userRecipeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $recipe_id = $article->recipe_id ?>
                    <div class="article_outline">
                        <div class="article">
                            <a href="">
                                <img class="comp_img" src="<?php echo $article->comp_img ?>">
                            </a>
                            <div class="article_right">
                                <div class="rightup">
                                    <h3><li><a href=""><?php echo $article->title ?></li></a></h3>
                                    <h3><li><a href="">難易度レベル:<?php echo $article->recipe_level ?></li></a></h3>
                                </div>
                                <div class="comment"><li><a href=""><?php echo $article->comment ?></a></li></div>
                            </div>
                        </div> 
                        <div class="flex">
                            <button>
                                <a href="<?php echo e(route('contEditLink',$recipe_id)); ?>">編集</a>
                            </button>
                            <button>
                                <a href="" onclick="return confirm('本当に削除しても宜しいですか？')">削除</a>
                            </button>
                        </div>
                    </div>    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views//Contribute_List.blade.php ENDPATH**/ ?>