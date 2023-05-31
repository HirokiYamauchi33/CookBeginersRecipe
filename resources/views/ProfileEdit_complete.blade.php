<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/ProfileEdit.css') }}">
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <div class="prof_outline">
                <h2>プロフィール編集</h2>
                <p>プロフィールを変更しました。</p> 
                <div class="ok">
                    <a href="{{route('profileLink')}}">プロフィールページへ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>