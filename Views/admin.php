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

//画像アップロード
require_once(ROOT_PATH .'Controllers/UploadController.php');
$upload = new UploadController();



?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $_SESSION['login_user']['id'];?>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>管理者画面</h2>
                <ul>
                    <li class="user"><a href="admin_userlist.php">ユーザー一覧</a></li>
                    <li class="con_List"><a href="admin_contributelist.php">投稿一覧</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>