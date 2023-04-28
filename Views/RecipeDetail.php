<?php
session_start();

require_once(ROOT_PATH .'Controllers/UploadController.php');
$upload = new UploadController();

require_once(ROOT_PATH .'Controllers/LoginController.php');
$user = new LoginController();

require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

// var_dump($_GET['id']);

$recipe_id = $_GET['id'];

//section2
$getMaterial = $recipeController->getMaterial($recipe_id);
//section1
$getResipe = $recipeController->getResipe($recipe_id);

$getTejun = $recipeController->getTejun($recipe_id);

//$countは手順コメントの数
$count = count($getTejun);

$getFile = $recipeController->getFile2($recipe_id,$count);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Top_Header.css">
    <link rel="stylesheet" href="css/Level_Header.css">
    <link rel="stylesheet" href="css/RecipeDetail.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include('Top_Header.php');?>
    <?php include('Level_Header.php');?>
    <div class="detail">
        <div class="wrap">
            <div class="inner">

                <div class="section1">
                <?php foreach($getResipe as $section1):?>
                    <h2><?php echo $section1['title']; ?></h2>
                    <div class="flex">
                        <img class="comp_img" src="<?php echo $section1['comp_img']; ?>">
                        <div class="section1_right">
                            <div class="flex">
                                <img class="user_img" src="<?php echo $section1['user_img']; ?>">
                                <p><?php echo $section1['nickname']; ?></p>
                            </div>
                            <p class="tk">投稿者からのコメント</p>
                            <p class="comment"><?php echo $section1['comment']; ?></p>
                        </div>
                    </div>
                <?php endforeach;?> 
                </div>

                <div class="section2">
                    <h3>材料</h3>
                    <!-- foreach -->
                    <?php foreach($getMaterial as $section2):?>
                    <div class="between">
                        <p><?php echo $section2['material']; ?></p>
                        <p><?php echo $section2['quanity']; ?></p>
                    </div>
                    <?php endforeach;?> 
                </div>

                <div class="section3">
                    <h3>作り方</h3>

                    <div class="tejun_grid">
                        <?php for($i = 0; $i< $count; $i++) { ?>
                        <div>
                            <h3><?php echo $i+1 ?></h3>
                            <div class="flex">
                                <img  src="<?php echo $getFile[$i]['file_path']; ?>">
                                <p><?php echo $getTejun[$i]['proce_com']; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>