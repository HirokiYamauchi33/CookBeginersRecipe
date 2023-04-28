<?php
require_once(ROOT_PATH .'Controllers/LoginController.php');
//ログイン状態の確認
$check = new LoginController();
$check_res = $check->verifyLogin();

//表示変数
$nodisplay='';
$display= "";
$admin_display ='';


//ログインしているかどうかによって表示される要素を変更
if($check_res){
    $nodisplay = "style='display:none;'";
    $display = "style='visibility:visible;'";
}else{
    $display = "style='display:none;'";
}
?>
<div class="header">
    <div class="upper">
        <div class="logo">
            <p>料理初心者向けレシピ投稿サイト</p>
        </div>
        <div class="head1">
            <ul>
                <li class="li1">
                    <a href="Register.php">
                        新規登録
                    </a>
                </li>
                <li class="li2" <?php echo $nodisplay;?>>
                    <a href="Login.php">
                        ログイン
                    </a>
                </li>
                <li class="li2" <?php echo $display;?>>
                    <a href="Logout.php">
                        ログアウト
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="lower">
        <div class="lower1"><a href="index.php">Cook Beginers Recipe</a></div>
        <div class="lower2">
            <a>お気に入りレシピ</a>
        </div>
        <div class="lower3">
            <a href="Profile.php">プロフィール</a>
        </div>
    </div>
</div>
