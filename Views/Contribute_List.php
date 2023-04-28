<?php
session_start();

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

$id = $_SESSION['login_user']['id'];

require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

$userRecipeList = $recipeController->getRecipeUser($id);



$user = $user->getUsers($id);

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Contribute_List.css">
</head>
<body>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿レシピ一覧</h2>
                <?php foreach($userRecipeList as $article):?>
                    <?php $recipe_id = $article['recipe_id']; ?>
                    <div class="article_outline">
                        <div class="article">
                            <a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>">
                                <img class="comp_img" src="<?php echo $article['comp_img']; ?>">
                            </a>
                            <div class="article_right">
                                <div class="rightup">
                                    <h3><li><a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>"><?php echo $article['title']; ?></li></a></h3>
                                    <h3><li><a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>">難易度レベル:<?php echo $article['recipe_level']; ?></li></a></h3>
                                </div>
                                <div class="comment"><li><a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>"><?php echo $article['comment']; ?></a></li></div>
                            </div>
                        </div> 
                        <?php $recipeid = $article['recipe_id']; ?>
                        <div class="flex">
                            <button>
                                <a href="Contribute_Edit.php?id=<?php echo $recipeid ?>">編集</a>
                            </button>
                            <button>
                                <a href="delete.php?id=<?php echo $recipeid ?>" onclick="return confirm('本当に削除しても宜しいですか？')">削除</a>
                            </button>
                        </div>
                    </div>    
                <?php endforeach;?> 
            </div>
        </div>
    </div>
</body>
</html>
