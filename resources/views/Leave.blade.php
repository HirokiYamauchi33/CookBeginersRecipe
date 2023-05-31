<?php
// session_start();
// require_once(ROOT_PATH .'Controllers/LoginController.php');
// $user = new LoginController();

// //　退会する
// $leave = $user->del_flg();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Top_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Register_complete.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
</head>
<body>
    @include('Top_Header')
    <div class="wrap">
        <div class="register_outline">
            <p >退会しました。</p> 
            <div class="ok">
                <a href="{{route('topLink')}}">トップページへ</a>
            </div>
        </div>
    </div>
    @include('footer')
</body>
</html>