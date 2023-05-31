<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/admin_userlist.css') }}">
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿一覧</h2>
                <p>投稿を削除しました。</p>
                <div class="ok">
                    <a href="{{route('adminLink')}}">管理者画面へ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>