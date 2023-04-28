<?php
session_start();

// var_dump($_SESSION['login_user']['id']);
require_once(ROOT_PATH .'Controllers/LoginController.php');
$user = new LoginController();

//レシピを取得
require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

//レシピ取得
$level = $_GET['level'];
$recipeList = $recipeController->getRecipeList($level);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Level_Recipe.css">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Level_Header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include('Top_Header.php');?>
    <?php include('Level_Header.php');?>
    <div class="main_top">
        <div class="wrap">
            <h2>難易度レベル:<?php echo $_GET['level']?></h2>

            <?php foreach($recipeList as $article):?>
                <?php $recipe_id = $article['recipe_id']; ?>
                <div class="article_outline">
                    <div class="article">
                        <a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>">
                            <img class="comp_img" src="<?php echo $article['comp_img']; ?>">
                        </a>
                        <div class="article_right">
                            <h3><li><a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>"><?php echo $article['title']; ?></li></a></h3>
                            <div class="rightdown">
                                <div class="downleft">
                                    <img src="<?php echo $article['user_img']; ?>">
                                    <p>投稿者:<?php echo $article['nickname']; ?></p>
                                </div>
                                <div class="comment">
                                    <li>
                                        <a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>">
                                            <?php echo $article['comment']; ?>
                                        </a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
            <?php endforeach;?>

        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>