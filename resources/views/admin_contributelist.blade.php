{{-- 
require_once(ROOT_PATH . 'Controllers/SelectRecipeController.php');
$recipeController = new SelectRecipeController();

$RecipeList = $recipeController->admingetRecipeList(); --}}

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/admin_contributelist.css') }}">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    @include('Profile_Header')
    <div class="wrap">
        @include('Profile_Side')
        <div class="main_column">
            <div class="prof_outline">
                <h2>投稿一覧</h2>
                @foreach($recipeList as $article)
                    @php $recipe_id = $article->recipe_id @endphp
                    <div class="article_outline">
                        <div class="article">
                                <img class="comp_img" src="@php echo $article->comp_img @endphp">
                            <div class="article_right">
                                <div class="rightup">
                                    <h3>@php echo $article->title @endphp</h3>
                                </div>
                                <div class="comment">@php echo $article->comment @endphp</div>
                            </div>
                        </div> 
                        <div class="button">
                            <button>
                                <a href="{{route('adminDeleteRecipeLink',$recipe_id)}}" onclick="return confirm('本当に削除しても宜しいですか？')">削除</a>
                            </button>
                        </div>
                    </div>    
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>