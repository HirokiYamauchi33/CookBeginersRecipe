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


//シークエンス
require_once(ROOT_PATH . 'Controllers/SelectSequenceController.php');
$getSequence = new SelectSequenceController();

//シークエンス情報取得
$recipe_id = $getSequence->getSequence();

$scs_msg = array();
$err_msg = array();


if(isset($_FILES)){
    for($i = 0; $i < count($_FILES['file']['name']); $i++ ){
        if($i == 0 && $_FILES['file']['name'][0] == ""){
            $err_msg['comp_image'] = '完成写真は必須項目です。';
        }
        //7回ループしたよ
        $filename = basename($_FILES['file']['name'][$i]);
        $tmp_path = $_FILES['file']['tmp_name'][$i];
        $file_err = $_FILES['file']['error'][$i];
        $filesize = $_FILES['file']['size'][$i];
        $upload_dir = 'images/';
        $save_filename = date('YmdHis') . $filename;
        $save_path = $upload_dir. $save_filename;

        //画像がなかったらループ終了
        if($filesize == 0){
            $filename = 'noimage.png';
            $save_path = 'images/noimage.png';
        }

        if($filesize > 1048576 || $file_err == 2){
            $err_msg[$i]['size'] = 'ファイルサイズは1MB未満にしてください。';
        }

        //拡張は画像形式か
        $allow_ext = array('jpg', 'jpeg', 'png');
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);


        if(count($err_msg) === 0){
            //ファイルはあるかどうか？
                if(is_uploaded_file($tmp_path) || $filename == 'noimage.png'){
                    if(move_uploaded_file($tmp_path, $save_path) || $filename == 'noimage.png'){
                        array_push($scs_msg, $filename . 'をアップしました。');
        
                        // DBに保存（ファイル名、ファイルパス）
                        $result = $upload->fileSave($filename, $save_path, $recipe_id, $i);
                        if($result){
                            array_push($scs_msg, 'データベースに保存しました。');
                        } else{
                            array_push($scs_msg, 'データベースへの保存が失敗しました。');

                        }
                    } else{
                        array_push($scs_msg, 'ファイルが保存できませんでした。');
                    }
                } else {
                    array_push($scs_msg, 'ファイルが選択されていません。');
                }
        }
    }
}

$users_id = $_SESSION['login_user']['id'];

try{
    if(isset($_POST)) {
        //固定値

        if(($_POST['title']) == ""){
            $err_msg['recipe']['title'] = 'タイトルは必須です。';
        }
        if(($_POST['comment']) == ""){
            $err_msg['recipe']['comment'] = 'コメントは必須です。';
        }
        if($_POST['procedure'][0] == ""){
            $err_msg['tejun'] = '一つ目は入力必須です。';
        }
        if($_POST['ma'][0] == ""){
            $err_msg['material']['ma'] = '材料の一つ目は入力必須です。';
        }
        if($_POST['qua'][0] == ""){
            $err_msg['material']['qua'] = '分量の一つ目は入力必須です。';
        }

        $title = $_POST['title'];
        $comment = $_POST['comment'];
        $level = $_POST['level'];

        if(count($err_msg) == 0){
            $result = $upload->recipeSave($title,$comment,$level,$users_id,$recipe_id); 

            // 以下ループ
            
            for ($i = 0; $i < count($_POST["ma"]); $i++) {

                //データが入ってなかったら
                if($_POST['ma'][$i] == ''){
                    break;
                }

                $material = $_POST['ma'][$i];
                $quanity = $_POST['qua'][$i];
                
                $result = $upload->materialSave($material, $quanity, $recipe_id); 

            }
        
            for ($i = 0; $i < count($_POST["procedure"]); $i++) {

                //コメントが無かったら
                if($_POST['procedure'][$i] == ''){
                    break;
                }

                $proce_num = $i +1;
                $proce_com = $_POST['procedure'][$i];

                $result = $upload->procedureSave($proce_num, $proce_com, $recipe_id);
                
            }
        }else{
            $_SESSION['error'] = $err_msg;
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }

    }
}catch(\Exception $e){
     echo $e;
    }



?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Contribute_complete.css">
</head>
<body>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <div class="prof_top">
                    <h2>投稿しました！</h2>
                    <div class="ok">
                        <a href="Profile.php">プロフィールページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>