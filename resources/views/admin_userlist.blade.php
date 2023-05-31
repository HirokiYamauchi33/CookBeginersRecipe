<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/admin_userlist.css') }}">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <div class="prof_outline">
                <h2>ユーザーリスト</h2>
                <table id="dbtable">
                    <thead>
                        <tr>
                            <th class="id">id</th> <th class="name">氏名</th> <th class="nickname">ニックネーム</th> <th class="email">メールアドレス</th> <th class="password">パスワード</th> <th class="rolr">ロール</th> <th class="operation">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userdata as $userdata)
                    @php $id = $userdata->id @endphp
                        <tr>
                            <th>@php echo $id @endphp</th>
                            <th>@php echo $userdata->name @endphp</th>
                            <th>@php echo $userdata->nickname @endphp</th>
                            <th>@php echo $userdata->email @endphp</th>
                            <th>@php echo $userdata->password @endphp</th>
                            <th>@php echo $userdata->role @endphp</th>
                            <th class="delete">
                            <a class="delete_button" href="{{route('adminDeleteLink',$id)}}" onclick="return confirm('削除してよろしいですか？')">削除</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>