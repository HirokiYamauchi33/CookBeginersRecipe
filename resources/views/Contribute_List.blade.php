<?php
// require_once(ROOT_PATH .'Controllers/LoginController.php');
// $user = new LoginController();

// $id = $_SESSION['login_user']['id'];

// require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
// $recipeController = new SelectRecipeController();

// $userRecipeList = $recipeController->getRecipeUser($id);

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Contribute_List.css') }}">
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿レシピ一覧</h2>
                @foreach($userRecipeList as $article)
                    @php $recipe_id = $article->recipe_id @endphp
                    <div class="article_outline">
                        <div class="article">
                            <a href="">
                                <img class="comp_img" src="@php echo $article->comp_img @endphp">
                            </a>
                            <div class="article_right">
                                <div class="rightup">
                                    <h3><li><a href="">@php echo $article->title @endphp</li></a></h3>
                                    <h3><li><a href="">難易度レベル:@php echo $article->recipe_level @endphp</li></a></h3>
                                </div>
                                <div class="comment"><li><a href="">@php echo $article->comment @endphp</a></li></div>
                            </div>
                        </div> 
                        <div class="flex">
                            <button>
                                <a href="{{route('contEditLink',$recipe_id)}}">編集</a>
                            </button>
                            <button>
                                <a href="" onclick="return confirm('本当に削除しても宜しいですか？')">削除</a>
                            </button>
                        </div>
                    </div>    
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
