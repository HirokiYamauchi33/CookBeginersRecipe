@php
//post
$error = session('error');
$email = session('email');

// var_dump(session('msg'));

@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Top_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Password_Reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
</head>
<body>
    @include('Top_Header')
    <div class="wrap">
        <div class="register_outline">
            <h2>パスワード再設定フォーム</h2>
            <p><span class="red">*</span>は必須項目となります。</p> 
            @if (isset($error))@foreach($error as $err)
                <p style="color: red;">{{$err}}</p>
                @endforeach
            @endif
            <form class="register" method="POST" action="/Password_Reset">
                @csrf
                <dl>
                    <dt>メールアドレス<span class="red">*</span></dt>
                    <dd>
                        <input type="email" name="email" id="email" value="@php if(isset($email)){echo $email;}@endphp" placeholder="test@test.co.jp">
                    </dd>
                    <dt>新しいパスワード<span class="red">*</span></dt>
                    <dd>
                        <input type="password" name="password" id="password" placeholder="5文字以上でご記入ください">
                    </dd>
                    <dt>パスワード確認<span class="red">*</span></dt>
                    <dd>
                        <input type="password" name="conf_password" id="conf_password" placeholder="5文字以上でご記入ください">
                    </dd>
                </dl>
                <dd class="button">
                    <button type="submit" name="submit" id="submit">送  信</button>
                </dd>
            </form>
        </div>
    </div>
    @include('footer')
</body>
</html>