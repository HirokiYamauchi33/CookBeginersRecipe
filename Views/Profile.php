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

$id = $_SESSION['login_user']['id'];

$user = $user->getUsers($id);



?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Profile.css">
</head>
<body>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <?php foreach($user as $user):?>
        <div class="main_column">
            <div class="prof_outline">
                <div class="prof_top">
                    <img class="img" src="<?php echo $user['prof_file_path'] ?>">
                    <div class="name">
                        <div>
                            <p><?php echo $user['nickname'] ?></p>
                        </div>
                        <div class="edit_button">
                            <a href="ProfileEdit.php">プロフィール編集</a>
                        </div>
                    </div>
                </div>
                <div class="prof_bottom">
                    <h3>コメント</h3>
                    <p><?php echo $user['greeting'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</body>
</html>