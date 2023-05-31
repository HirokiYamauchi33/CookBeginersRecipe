<?php
//表示変数
$nodisplay='';
$display= "";
$admin_display ='';

//ログインしているかどうかによって表示される要素を変更
if($role == 1){
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
    <link rel="stylesheet" href="<?php echo e(asset('/css/Profile_Side.css')); ?>">
</head>
<body>
    <div class="side_column">
        <ul class="prof_side_list">
            <li>
                <a href="<?php echo e(route('contributeLink')); ?>">レシピ投稿</a>
            </li>
            <li>
                <a href="<?php echo e(route('contListLink')); ?>">投稿レシピ一覧</a>
            </li>
            <li>
                <a>お気に入りレシピ</a>
            </li>
            <li <?php echo $display;?>>
                <a href="<?php echo e(route('adminLink')); ?>">管理者画面</a>
            </li>
            <li>
                <a id="logout" href="<?php echo e(route('logoutLink')); ?>" onclick="return confirm('本当にログアウトしますか？')">ログアウト</a>
            </li>
            <li class="last">
                <a id="leave" href="<?php echo e(route('leaveLink')); ?>" onclick="return confirm('本当に退会しても宜しいですか？')">退会</a>
            </li>
        </ul>
    </div>
    <!-- <script src="js/Profile.js"></script> -->
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/Profile_Side.blade.php ENDPATH**/ ?>