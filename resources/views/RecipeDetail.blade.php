<?php
// require_once(ROOT_PATH .'Controllers/UploadController.php');
// $upload = new UploadController();

// $getTejun = $recipeController->getTejun($recipe_id);

//$countは手順コメントの数
// $count = count($getTejun);
//ok
// var_dump($getFile);

$file = [];
foreach($getFile as $f){
$data = $f->file_path;
array_push($file,$data);
}

$tejun =[];
foreach($getTejun as $t){
$data = $t->proce_com;
array_push($tejun,$data);
}

// $getFile = $recipeController->getFile2($recipe_id,$count);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Top_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Level_Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/RecipeDetail.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
</head>
<body>
@include('Top_Header')
    @include('Level_Header')
    <div class="detail">
        <div class="wrap">
            <div class="inner">

                <div class="section1">
                @foreach($getRecipe as $section1)
                    <h2>@php echo $section1->title @endphp</h2>
                    <div class="flex">
                        <img class="comp_img" src="{{asset($section1->comp_img)}}">
                        <div class="section1_right">
                            <div class="flex">
                                <img class="user_img" src="{{asset($section1->user_img)}}">
                                <p>@php echo $section1->nickname @endphp</p>
                            </div>
                            <p class="tk">投稿者からのコメント</p>
                            <p class="comment">@php echo $section1->comment @endphp</p>
                        </div>
                    </div>
                @endforeach
                </div>

                <div class="section2">
                    <h3>材料</h3>
                    <!-- foreach -->
                    @foreach($getMaterial as $section2)
                    <div class="between">
                        <p>@php echo $section2->material @endphp</p>
                        <p>@php echo $section2->quanity @endphp</p>
                    </div>
                    @endforeach
                </div>

                <div class="section3">
                    <h3>作り方</h3>
                    <div class="tejun_grid">
                        <?php for($i = 0; $i< $count; $i++) { ?>
                        <div>
                            <h3><?php echo $i+1 ?></h3>
                            <div class="flex">
                                <img  src="{{asset( $file[$i])}}">
                                <p>@php echo $tejun[$i] @endphp</p>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
                

            </div>
        </div>
    </div>
    @include('footer')
</body>
</html>