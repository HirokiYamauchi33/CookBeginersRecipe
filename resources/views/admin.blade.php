<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <div class="prof_outline">
                <h2>管理者画面</h2>
                <ul>
                    <li class="user"><a href="{{route('adminUserListLink')}}">ユーザー一覧</a></li>
                    <li class="con_List"><a href="{{route('admincontListLink')}}">投稿一覧</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>