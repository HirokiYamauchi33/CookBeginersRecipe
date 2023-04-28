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

require_once(ROOT_PATH .'Controllers/DeleteRecipeController.php');
$deleteController = new DeleteRecipeController();

$id = $_GET['id'];
//recipe_idをもとに保存した写真をディレクトリから削除
$deleteuser = $check->admindeleteUser($id);






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
                <h2>ユーザーリスト</h2>
                <p>ユーザーを削除しました。</p>
                <div class="ok">
                    <a href="admin.php">管理者画面へ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>