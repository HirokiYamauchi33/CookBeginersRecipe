<?php

// require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
// $recipeController = new SelectRecipeController();

// $newRecipeList = $recipeController->getNewRecipe();

// var_dump($_SESSION['login_user']['status']);

// var_dump($newRecipeList);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Top.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Top_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Level_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
</head>
<body>
@include('Top_Header')
@include('Level_Header')
    <div class="main_top">
        <div class="wrap">
            <h2>最新の投稿</h2>
            <div class="article_outline">
            @foreach($newRecipeList as $article)
                @php $recipe_id = $article->recipe_id @endphp
                <div class="article">
                    <a href="{{route('recipeDetailLink',$recipe_id)}}">
                        <img class="comp_img" src="@php echo $article->file_path @endphp">
                    </a>
                    <div class="article_right">
                        <h3><li><a href="{{route('recipeDetailLink',$recipe_id)}}">@php echo $article->title @endphp</li></a></h3>
                        <div class="rightdown">
                            <div class="downleft">
                                <img src="@php echo $article->prof_file_path @endphp">
                                <p>投稿者:@php echo $article->nickname @endphp</p>
                            </div>
                            <div class="comment"><li><a href="{{route('recipeDetailLink',$recipe_id)}}">@php echo $article->comment @endphp</li></a></div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@include('footer')
</body>
</html>