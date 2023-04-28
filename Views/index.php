<?php
session_start();

require_once(ROOT_PATH .'Controllers/UploadController.php');
$upload = new UploadController();

require_once(ROOT_PATH .'Controllers/LoginController.php');
$user = new LoginController();

require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

$newRecipeList = $recipeController->getNewRecipe();

$err = [];

// var_dump($_SESSION['login_user']['status']);

//ログインページからアクセスされた場合
if(isset($_SERVER['HTTP_REFERER']) && (preg_match("/Login.php/",$_SERVER['HTTP_REFERER'])))
{

    if(isset($_POST)){
        if(empty($_POST['email'])){
            $err['email'] = "メールアドレスを入力してください。";
        }
        if(empty($_POST['password'])){
            $err['password'] = "パスワードを入力してください。";
        }

        if(count($err) > 0){
            $_SESSION = $err;
            header('Location: Login.php');
            return;
        }
    }

    //バリデーション
    if(!$email = filter_input(INPUT_POST,'email'))
    {
        $err['email'] = "メールアドレスを入力してください。";
    }
    if(!$password = filter_input(INPUT_POST,'password'))
    {
        $err['password'] = "パスワードを入力してください。";
    }



    //ログアウトボタンを表示するために強制的にリフレッシュ
    header("Refresh:0");
    // $_SESSION['email'] = $_POST['email'];

    $user = new LoginController();
    $result = $user->login();


    //エラーがあった場合はログインページに戻す
    if(count($err) > 0) {
        $_SESSION = $err;
        $_SESSION = $user['password'];
        header('Location: Login.php');
        return;
    }
    
    if($result === false){
        header('Location: Login.php');
        return;
    }
    

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top.css">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Level_Header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include('Top_Header.php');?>
    <?php include('Level_Header.php');?>
    <div class="main_top">
        <div class="wrap">
            <h2>最新の投稿</h2>
            <div class="article_outline">
            <?php foreach($newRecipeList as $article):?>
                <?php $recipe_id = $article['recipe_id']; ?>
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
                            <div class="comment"><li><a href="RecipeDetail.php?id=<?php echo $recipe_id; ?>"><?php echo $article['comment']; ?></li></a></div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>