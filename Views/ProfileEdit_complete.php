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

//画像アップロード
require_once(ROOT_PATH .'Controllers/UploadController.php');
$upload = new UploadController();

$scs_msg = array();
$err_msg = array();

$error_count = 0;

$id = $_SESSION['login_user']['id'];

if(isset($_POST)){

    //コメントバリデーション
    if($_POST['greeting'] == ' '){
        $error['greeting']['set'] = 'メッセージは必須入力です。';
        $error_count += 1;
    }elseif(100 < mb_strlen($_POST['password'], 'UTF-8') ){
        $error['greeting']['mb'] = 'メッセージは100文字以内で入力してください。';
    }

    //名前バリデーション
    if($_POST['name'] == ' '){
        $error['name'] = '名前は必須入力です。';
        $error_count += 1;
    }

    //
    if($_POST['nickname'] == ' '){
        $error['nickname']['set'] = 'ニックネームは必須入力です。';
        $error_count += 1;
    } elseif( 10 < mb_strlen($_POST['nickname'], 'UTF-8') ) {
        $error['nickname']['mb'] = 'ニックネームは10文字以内で入力してください。';
    }

    //emailバリデーション
    if($_POST['email'] == ' ') {
        $error['email']['set'] = 'メールアドレスは必須入力です。';
        $error_count += 1;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email']['vali'] = 'メールアドレスは正しくご入力ください。';
        $error_count += 1;
    }

    //passwordバリデーション
    if($_POST['password'] == ' '){
        $error['password']['set']= 'パスワードは必須入力です。';
        $error_count += 1;
    }elseif(5 > mb_strlen($_POST['password'], 'UTF-8') ){
        $error['password']['mb'] = 'ニックネームは5文字以上で入力してください。';
    }

    if(isset($_FILES)){
        $filename = basename($_FILES['file']['name']);
        $tmp_path = $_FILES['file']['tmp_name'];
        $file_err = $_FILES['file']['error'];
        $filesize = $_FILES['file']['size'];
        $upload_dir = 'Profile_images/';
        $save_filename = date('YmdHis') . $filename;
        $save_path = $upload_dir. $save_filename;
    
        if($filesize > 1048576 || $file_err == 2){
            $error['size'] = 'ファイルサイズは1MB未満にしてください。';
            $error_count += 1;
        }
    
        //拡張は画像形式か
        $allow_ext = array('jpg', 'jpeg', 'png');
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

        //ファイルはあるかどうか？
        if(is_uploaded_file($tmp_path)){
            if(move_uploaded_file($tmp_path, $save_path)){
                array_push($scs_msg, $filename . 'をアップしました。');

                //DBに保存（ファイル名、ファイルパス）
                $result = $upload->profileSave($filename, $save_path, $id);
                if($result){
                    array_push($scs_msg, 'データベースに保存しました。');
                } else{
                    $error['image'] = '画像が保存できませんでした。';

                }
            } else{
                array_push($scs_msg, 'ファイルが保存できませんでした。');
            }
        } else {
            array_push($scs_msg, 'ファイルが選択されていません。');
        }
    
    
        if($error_count == 0){
            $name = $_POST['name'];
            $greeting = $_POST['greeting'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $nickname = $_POST['nickname'];

            $result = $user->updateUser($name,$greeting,$nickname,$email,$password,$id);
        }
        else{
            $_SESSION['error'] = $error;
            header('Location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ProfileEdit.css">
</head>
<body>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <h2>プロフィール編集</h2>
                <p>プロフィールを変更しました。</p> 
                <div class="ok">
                    <a href="Profile.php">プロフィールページへ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>