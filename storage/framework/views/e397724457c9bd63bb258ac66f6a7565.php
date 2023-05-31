<?php
// require_once(ROOT_PATH .'Controllers/LoginController.php');
// //ログイン状態の確認
// $check = new LoginController();
// $check_res = $check->verifyLogin();

//表示変数
$nodisplay='';
$display= "";
$admin_display ='';

// var_dump(session('result'));
//ログインしているかどうかによって表示される要素を変更
if($result == true){
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
                    <a href="<?php echo e(route('registerLink')); ?>">
                        新規登録
                    </a>
                </li>
                <li class="li2" <?php echo $nodisplay;?>>
                    <a href="<?php echo e(route('loginLink')); ?>">
                        ログイン
                    </a>
                </li>
                <li class="li2" <?php echo $display;?>>
                    <a href="<?php echo e(route('logoutLink')); ?>">
                        ログアウト
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="lower">
        <div class="lower1"><a href="<?php echo e(route('topLink')); ?>">Cook Beginers Recipe</a></div>
        <div class="lower2">
            <a>お気に入りレシピ</a>
        </div>
        <div class="lower3">
            <a href="<?php echo e(route('profileLink')); ?>">プロフィール</a>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/Top_Header.blade.php ENDPATH**/ ?>