@php
if(isset($msg)){
    var_dump($msg);
};

$greeting_err = session('greeting_error');
$name_err = session('name_error');
$nickname_err = session('nickname_error');
$email_err = session('email_error');
$pass_err = session('password_error');

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('/js/UploadImage.js') }}" type="text/javascript" defer></script>
    <link rel="stylesheet" href="{{ asset('/css/ProfileEdit.css') }}">
</head>
<body>
    @foreach($users as $users)
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <form class="prof_edit" action="/ProfileEdit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="prof_outline">
                    <h2>プロフィール編集</h2>
                    <div class="prof_top">
                        <img id="picture" src="@php echo $users->prof_file_path @endphp">
                        <div class="upload" class="top_picture">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                            <input id="image" multiple name="file" type="file" accept="image/*">
                        </div>
                    </div>
                    <div>
                        <h2>一言コメント</h2>
                        @if(isset($greeting_err)) @foreach($greeting_err as $err)
                        <p class="red">{{$err}}</p> @endforeach
                        @endif
                        <textarea class="greeting" name="greeting">@php echo $users->greeting @endphp</textarea>
                    </div>
                        <dl>
                            <dt>氏名</dt>
                            @if(isset($name_err)) @foreach($name_err as $err)
                            <p class="red">{{$err}}</p> @endforeach
                            @endif
                            <dd>
                                <input type="text" name="name" id="name" placeholder="山田太郎" value="@php echo $users->name @endphp">
                            </dd>
                            <dt>ニックネーム</dt>
                            @if(isset($nickname_err)) @foreach($nickname_err as $err)
                            <p class="red">{{$err}}</p> @endforeach
                            @endif
                            <dd>
                                <input type="text" name="nickname" id="nickname" placeholder="ニックネーム" value="@php echo $users->nickname @endphp">
                            </dd>
                            <dt>メールアドレス</span></dt>
                            @if(isset($email_err)) @foreach($email_err as $err)
                            <p class="red">{{$err}}</p> @endforeach
                            @endif
                            <dd>
                                <input type="text" name="email" id="email" placeholder="test@test.co.jp">
                            </dd>
                            <dt>パスワード</span></dt>
                            @if(isset($pass_err)) @foreach($pass_err as $err)
                            <p class="red">{{$err}}</p> @endforeach
                            @endif
                            <dd>
                                <input type="text" name="password" id="password" placeholder="5文字以上でご記入ください">
                            </dd>
                        </dl>
                        <dd class="button">
                            <button type="submit" name="submit" id="submit">送  信</button>
                        </dd>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</body>
</html>