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

//データの取得
$userdata = $check->admingetUser();

?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_userlist.css">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $_SESSION['login_user']['id'];?>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>ユーザーリスト</h2>
                <table id="dbtable">
                    <thead>
                        <tr>
                            <th class="id">id</th> <th class="name">氏名</th> <th class="nickname">ニックネーム</th> <th class="email">メールアドレス</th> <th class="password">パスワード</th> <th class="rolr">ロール</th> <th class="operation">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($userdata as $userdata):?>
                        <tr>
                            <th><?php echo $userdata['id']; ?></th>
                            <th><?php echo $userdata['name']; ?></th>
                            <th><?php echo $userdata['nickname']; ?></th>
                            <th><?php echo $userdata['email']; ?></th>
                            <th><?php echo $userdata['password']; ?></th>
                            <th><?php echo $userdata['role']; ?></th>
                            <th class="delete">
                            <a class="delete_button" href="admin_delete.php?id=<?php echo $userdata['id'] ?>" onclick="return confirm('削除してよろしいですか？')">削除</a>
                            </th>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>