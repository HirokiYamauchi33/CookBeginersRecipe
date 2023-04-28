<?php
session_start();
require_once(ROOT_PATH .'Controllers/LoginController.php');
$user = new LoginController();

//ログイン状態の確認
$check = new LoginController();
$check_res = $check->verifyLogin();

//ログインせずにアクセスでindex.phpへ
if(!$check_res){
    header('Location: index.php');
    return;
}

//　退会する
$leave = $user->del_flg();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Register_complete.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include('Top_Header.php');?>
    <div class="wrap">
        <div class="register_outline">
            <p >退会しました。</p> 
            <div class="ok">
                <a href="index.php">トップページへ</a>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>