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

$scs_msg = array();
$err_msg = array();

require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

$recipe_id = $_GET['id'];

//section2
$getMaterial = $recipeController->getMaterial($recipe_id);

//section1
$getResipe = $recipeController->getResipe($recipe_id);

$getTejun = $recipeController->getTejun($recipe_id);


$_SESSION['recipe_id'] = $recipe_id;
?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Contribute_Edit.css">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php include('Profile_Header.php'); ?>
    <div class="wrap">
        <?php include('Profile_Side.php'); ?>
        <div class="main_column">
            <div class="prof_outline">
                <form action="Contribute_Edit_complete.php" method="POST" enctype="multipart/form-data" class="upload_form"> 
                    <!-- <form method="POST" action="Contribute_complete.php"> -->
                    <?php foreach($getResipe as $section1):?>
                        <div class="img_upload">
                            <div class="upload">
                                <h2>完成写真のアップロード</h2>
                                <!-- （3）formタグで送信したfile情報はここに表示 -->
                                <p class="red">
                                    <?php
                                        foreach($err_msg as $msg){
                                            echo $msg;
                                            echo '<br>';   
                                        }
                                    ?>
                                </p>
                                <p><?php
                                        foreach($scs_msg as $msg){
                                            echo $msg;
                                            echo '<br>';   
                                        }                                           
                                    ?>
                                </p>
                                <div class="flex">
                                    <img id="picture" src="<?php echo $section1['comp_img']; ?>">
                                    <div>
                                        <!-- （2）input 属性はtype="file" と指定-->
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                        <input id="image" multiple name="file[]" type="file" accept="image/*" class="top_picture">
                                        <!-- 送信ボタン -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mid_info">
                                <div class="mid">
                                    <label for="title">タイトル:</label>
                                    <input type="title" name="title" value="<?php echo $section1['title']; ?>">
                                </div>
                                <div class="mid">
                                    <label for="comment">コメント:</label>
                                    <input type="comment" name="comment" value="<?php echo $section1['comment']; ?>">
                                </div>
                                <div class="mid">
                                    <label for="level">難易度:</label>
                                    <select name="level">
                                        <option value="<?php echo $section1['level']; ?>" selected>変更があれば選択してください</option>
                                        <option value="1">★☆☆☆☆</option>
                                        <option value="2">★★☆☆☆</option>
                                        <option value="3">★★★☆☆</option>
                                        <option value="4">★★★★☆</option>
                                        <option value="5">★★★★★</option>
                                    </select>
                                </div>
                        </div>
                    <?php endforeach;?> 

                    <div class="material">
                        <h2>必要材料</h2>
                        <div class="grid">

                            <?php 
                                $count = count($getMaterial);
                                for($i = 0; $i< 12; $i++) { 
                            ?>

                            <div class="flex">
                                <h3><?php echo $i+1 ?></h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]" value="<?php if(isset($getMaterial[$i]['material'])){echo $getMaterial[$i]['material'];}?>">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]" value="<?php if(isset($getMaterial[$i]['quanity'])){echo $getMaterial[$i]['quanity'];}?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>

                    <?php 
                    //$countは手順コメントの数
                    $count = count($getTejun);

                    $getFile = $recipeController->getFile2($recipe_id,$count);
                    ?>
                    <div class="procedure">
                        <h2>手順</h2>
                            <div class="proce_grid">
                            <?php for($i = 0; $i< 6; $i++) { ?>
                                <div class="flex">
                                    <h3><?php echo $i+1 ?></h3>
                                    <div>
                                        <img class="proce_img" id="picture_2" src="<?php echo $getFile[$i]['file_path']; ?>">
                                        <p>写真を選択</p>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                        <input id="image_2" multiple name="file[]" type="file" accept="image/*">
                                        <div class="down">
                                            <p>手順コメント</p>
                                            <textarea type="procedure" name="procedure[]"><?php if(isset($getTejun[$i]['proce_com'])){echo $getTejun[$i]['proce_com'];}?></textarea>
                                        </div>                                   
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                    </div>
                    <div>
                        <p class="submit">
                            <input id="submit" type="submit" value="上記内容を確認">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>