@php

//get
$nickname = session('nickname');
$filename = session('filename');
$filepath = session('filepath');

//post
$error = session('error');
$name = session('name');
$email = session('email');

@endphp

<?php
// require_once(ROOT_PATH .'Controllers/LoginController.php');

// $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
// $nickname = substr(str_shuffle($str), 0, 8);

// $errors = [];
// if(isset($_POST['submit'])){
//     //氏名
//     if (empty($_POST['name'])) {
//         $errors['name'] = '氏名は必須入力です。';
//     } elseif (10 < mb_strlen($_POST['name'])) {
//         $errors['name'] = '10文字以内で入力してください';
//     }

//     //メールアドレス
//     if (empty($_POST['email'])) {
//         $errors['email'] = 'メールアドレスは必須入力です。';
//     } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//         $errors['email'] = 'メールアドレスは正しくご入力ください。';
//     }

//     //パスワード
//     if (empty($_POST['password'])) {
//         $errors['password'] = 'パスワードは必須入力です。';
//     } elseif (5 > mb_strlen($_POST['password'])) {
//         $errors['password'] = '6文字以上で入力してください。';
//     }

//     //エラーがなかった場合の処理
//     // if (count($errors) == 0) {

//     //     $user = new LoginController();
//     //     $params = $user->newUser();

//     //     $filename = 'noimage.png';
//     //     $filepath = 'Profile_images/noimage.png';
//     //     $params = $user->newUserImage($filename,$filepath);


//     //     if(isset($_SESSION)){
//     //         session_destroy();
//     //     }
//     //     header('Location:Register_complete.php');
//     // }
//     // $_SESSION['name'] = $_POST['name'];
//     // $_SESSION['email'] = $_POST['email'];
// }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Top_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Register.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
</head>
<body>
    @include('Top_Header')
    <div class="wrap">
        <div class="register_outline">
            <h2>新規登録フォーム</h2>
            <p><span class="red">*</span>は必須項目となります。</p> 
            @if (isset($error))@foreach($error as $err)
                <p style="color: red;">{{$err}}</p>
                @endforeach
            @endif
            <form class="register" method="POST" action="/Register">
                @csrf
                <dl>
                    <dt>氏名<span class="red">*</dt>
                    <dd>
                        <input type="text" name="name" id="fullname" value="@php if(isset($name)){echo $name;}@endphp" placeholder="山田太郎">
                    </dd>
                    <dt>メールアドレス<span class="red">*</span></dt>
                    <dd>
                        <input type="email" name="email" id="email" value="@php if(isset($email)){echo $email;}@endphp" placeholder="test@test.co.jp">
                    </dd>
                    <dt>パスワード<span class="red">*</span></dt>
                    <dd>
                        <input type="password" name="password" id="password" value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];} ?>" placeholder="5文字以上でご記入ください">
                    </dd>
                    <dt>パスワード確認<span class="red">*</span></dt>
                    <dd>
                        <input type="password" name="conf_password" id="conf_password" placeholder="5文字以上でご記入ください">
                    </dd>
                </dl>
                <dd class="button">
                    <button type="submit" name="submit" id="submit">送  信</button>
                </dd>
                <input type="hidden" name="nickname" id="nickname" value="@php echo $nickname; @endphp">
                <input type="hidden" name="filename" id="filename" value="@php echo $filename; @endphp">
                <input type="hidden" name="filepath" id="filepath" value="@php echo $filepath; @endphp">
            </form>
        </div>
    </div>
    @include('footer')
</body>
</html>