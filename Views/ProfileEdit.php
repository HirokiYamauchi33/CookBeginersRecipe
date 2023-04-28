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
//画像アップロード
require_once(ROOT_PATH .'Controllers/UploadController.php');
$upload = new UploadController();
//User情報を取得
$users = $user->getUsers($id);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ProfileEdit.css">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php foreach($users as $users): ?>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <form class="prof_edit" action="ProfileEdit_complete.php" method="POST" enctype="multipart/form-data">
                <div class="prof_outline">
                    <h2>プロフィール編集</h2>
                    <div class="prof_top">
                        <?php $prof_file_path = $users['prof_file_path'];?>
                        <img id="profpic" src="<?php echo $users['prof_file_path']; ?>">
                        <div class="upload" class="top_picture">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                            <input id="profimg" multiple name="file" type="file" accept="image/*">
                        </div>
                    </div>
                    <div>
                        <h2>一言コメント</h2>
                        <p class="red"><?php if(isset($_SESSION['error']['greering'])){echo $_SESSION['error']['greeting'];} ;?></p>
                        <textarea class="greeting" name="greeting"><?php echo $users['greeting']; ?></textarea>
                    </div>
                        <dl>
                            <dt>氏名</dt>
                            <p class="red"><?php if(isset($_SESSION['error']['name'])){echo $_SESSION['error']['name'];} ;?></p>
                            <dd>
                                <input type="text" name="name" id="name" placeholder="山田太郎" value="<?php echo $users['name']; ?>">
                            </dd>
                            <dt>ニックネーム</dt>
                            <p class="red"><?php if(isset($_SESSION['error']['nickname']['set'])){echo $_SESSION['error']['nickname']['set'];} ;?></p>
                            <p class="red"><?php if(isset($_SESSION['error']['nickname']['mb'])){echo $_SESSION['error']['nickname']['mb'];} ;?></p>
                            <dd>
                                <input type="text" name="nickname" id="nickname" placeholder="ニックネーム" value="<?php echo $users['nickname']; ?>">
                            </dd>
                            <dt>メールアドレス</span></dt>
                            <p class="red"><?php if(isset($_SESSION['error']['email']['set'])){echo $_SESSION['error']['email']['set'];} ;?></p>
                            <p class="red"><?php if(isset($_SESSION['error']['email']['vali'])){echo $_SESSION['error']['email']['vali'];} ;?></p>
                            <dd>
                                <input type="text" name="email" id="email" placeholder="test@test.co.jp">
                            </dd>
                            <dt>パスワード</span></dt>
                            <p class="red"><?php if(isset($_SESSION['error']['password']['set'])){echo $_SESSION['error']['password']['set'];} ;?></p>
                            <p class="red"><?php if(isset($_SESSION['error']['password']['mb'])){echo $_SESSION['error']['password']['mb'];} ;?></p>
                            <dd>
                                <input type="text" name="password" id="password" placeholder="5文字以上でご記入ください">
                            </dd>
                        </dl>
                        <dd class="button">
                            <button type="submit" name="submit" id="submit">送  信</button>
                        </dd>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach;?> 
</body>
</html>