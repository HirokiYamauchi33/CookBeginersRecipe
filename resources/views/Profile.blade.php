<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Profile.css') }}">
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        @foreach($user as $user)
        <div class="main_column">
            <div class="prof_outline">
                <div class="prof_top">
                    <img class="img" src="@php echo $user->prof_file_path @endphp">
                    <div class="name">
                        <div>
                            <p>@php echo $user->nickname @endphp</p>
                        </div>
                        <div class="edit_button">
                            <a href="{{route('profEditLink')}}">プロフィール編集</a>
                        </div>
                    </div>
                </div>
                <div class="prof_bottom">
                    <h3>コメント</h3>
                    <p>@php echo $user->greeting @endphp</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>