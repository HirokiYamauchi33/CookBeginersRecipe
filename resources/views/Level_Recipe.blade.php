<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Level_Recipe.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Top_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Level_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
</head>
<body>
    @include('Top_Header')
    @include('Level_Header')
    <div class="main_top">
        <div class="wrap">
            <h2>難易度レベル:@php echo $level @endphp</h2>

            @foreach($recipeList as $article)
                @php $recipe_id = $article->recipe_id @endphp
                <div class="article_outline">
                    <div class="article">
                        <a href="{{route('recipeDetailLink',$recipe_id)}}">
                            <img class="comp_img" src="{{asset($article->comp_img)}}">
                        </a>
                        <div class="article_right">
                            <h3><li><a href="{{route('recipeDetailLink',$recipe_id)}}">@php echo $article->title @endphp</li></a></h3>
                            <div class="rightdown">
                                <div class="downleft">
                                    <img src="{{asset($article->user_img)}}">
                                    <p>投稿者:@php echo $article->nickname @endphp</p>
                                </div>
                                <div class="comment">
                                    <li>
                                        <a href="{{route('recipeDetailLink',$recipe_id)}}">
                                            @php echo $article->comment @endphp
                                        </a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
            @endforeach

        </div>
    </div>
    @include('footer')
</body>
</html>