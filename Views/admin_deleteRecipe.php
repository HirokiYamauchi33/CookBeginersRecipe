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

$recipe_id = $_GET['id'];


require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

require_once(ROOT_PATH .'Controllers/DeleteRecipeController.php');
$deleteController = new DeleteRecipeController();


//recipe_idをもとに保存した写真をディレクトリから削除
$deletefile = $recipeController->getFile($recipe_id);


$success_count = 0;
$error_count = 0;

$noimage ='images/noimage.png';

foreach($deletefile as $data){

    $file_path = $data['file_path'];
    if($file_path !== $noimage){
        if(unlink($file_path)){
            $success_count = $success_count + 1;
        }else{
            $error_count = $error_count + 1;
        }
    }
    
}

echo $success_count;
echo '<br>';

if($error_count == 0){

    //recipe_idからレシピを削除
    $deleteRecipe = $deleteController->deleteRecipe($recipe_id); 
}else{
    echo $error_count;
    echo 'レシピ削除できていませんよ';
}






?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_userlist.css">
</head>
<body>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿一覧</h2>
                <p>投稿を削除しました。</p>
                <div class="ok">
                    <a href="admin.php">管理者画面へ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>