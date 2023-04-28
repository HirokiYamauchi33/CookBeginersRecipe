<?php
session_start();

// var_dump($_SESSION['login_user']['id']);
require_once(ROOT_PATH .'Controllers/LoginController.php');
$user = new LoginController();

//ログイン状態の確認
$check = new LoginController();
$check_res = $check->verifyLogin();

//ログインせずにアクセスでLogin.phpへ
if(!$check_res){
    header('Location:Login.php');
    return;
}

require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

$RecipeList = $recipeController->admingetRecipeList();

?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_contributelist.css">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $_SESSION['login_user']['id'];?>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿一覧</h2>
                <?php foreach($RecipeList as $article):?>
                    <?php $recipe_id = $article['recipe_id']; ?>
                    <div class="article_outline">
                        <div class="article">
                                <img class="comp_img" src="<?php echo $article['comp_img']; ?>">
                            <div class="article_right">
                                <div class="rightup">
                                    <h3><?php echo $article['title']; ?></h3>
                                </div>
                                <div class="comment"><?php echo $article['comment']; ?></div>
                            </div>
                        </div> 
                        <?php $recipeid = $article['recipe_id']; ?>
                        <div class="button">
                            <button>
                                <a href="admin_deleteRecipe.php?id=<?php echo $recipeid ?>" onclick="return confirm('本当に削除しても宜しいですか？')">削除</a>
                            </button>
                        </div>
                    </div>    
                <?php endforeach;?> 
            </div>
        </div>
    </div>
</body>
</html>