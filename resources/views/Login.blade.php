@php
$err = session('err');
$mailerr = session('mailmsg');
$pwerr = session('pwmsg');
$email = session('email');

@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Top_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Login.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
</head>
<body>
@include('Top_Header')
    <div class="wrap">
        <div class="Login_outline">
            <h2>ログインフォーム</h2>
            @if (isset($err))@foreach($err as $err)
                <p style="color: red;">{{$err}}</p>
                @endforeach
            @endif
            @if (isset($mailerr))
                <p style="color: red;">{{$mailerr}}</p>
            @endif
            @if (isset($pwerr))
                <p style="color: red;">{{$pwerr}}</p>
            @endif
            <form class="Login" action="/Login" method="POST">
                @csrf
                <dl>
                    <dt>メールアドレス</span></dt>
                    <dd>
                        <input type="email" name="email" id="email" value="@php if(isset($email)){echo $email;}@endphp ">
                    </dd>
                    <dt>パスワード</span></dt>
                    <dd>
                        <input type="password" name="password" id="password">
                    </dd>
                </dl>
                <dd>
                    <p class="submit">
                        <input id="submit" type="submit" value="ログイン">
                    </p>
                </dd>
            </form>
            <div class="passwordreset"><a href="{{route('passResetLink')}}">パスワードを忘れた方はこちら</a></div>
        </div>
    </div>
    @include('footer')
</body>
</html>