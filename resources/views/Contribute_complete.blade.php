<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Contribute_complete.css') }}">
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <div class="prof_outline">
                <div class="prof_top">
                    <h2>投稿しました！</h2>
                    <div class="ok">
                        <a href="{{route('profileLink')}}">プロフィールページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>