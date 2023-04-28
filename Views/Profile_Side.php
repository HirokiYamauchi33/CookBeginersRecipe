<?php
require_once(ROOT_PATH .'Controllers/LoginController.php');
//ログイン状態の確認
$check = new LoginController();
$check_res = $check->verifyLogin();

//表示変数
$nodisplay='';
$display= "";
$admin_display ='';

$admin = $_SESSION['login_user']['role'];

//ログインしているかどうかによって表示される要素を変更
if($admin == 1){
    $nodisplay = "style='display:none;'";
    $display = "style='visibility:visible;'";
}else{
    $display = "style='display:none;'";
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Profile_Side.css">
</head>
<body>
    <div class="side_column">
        <ul class="prof_side_list">
            <li>
                <a href="Contribute.php">レシピ投稿</a>
            </li>
            <li>
                <a href="Contribute_List.php">投稿レシピ一覧</a>
            </li>
            <li>
                <a>お気に入りレシピ</a>
            </li>
            <li <?php echo $display;?>>
                <a href="admin.php">管理者画面</a>
            </li>
            <li>
                <a id="logout" href="Logout.php" onclick="return confirm('本当にログアウトしますか？')">ログアウト</a>
            </li>
            <li class="last">
                <a id="leave" href="Leave.php" onclick="return confirm('本当に退会しても宜しいですか？')">退会</a>
            </li>
        </ul>
    </div>
    <!-- <script src="js/Profile.js"></script> -->
</body>
</html>