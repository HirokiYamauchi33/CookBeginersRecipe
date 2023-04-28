<?php
require_once(ROOT_PATH .'/Models/SelectRecipe.php');

class SelectRecipeController {

    private $SelectRecipe;

    public function __construct() {
                // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        // モデルオブジェクトの生成
        $this->SelectRecipe = new SelectRecipe();
    }

    public function getRecipeList($level){
        $data = $this->SelectRecipe->getRecipeList($level);
        return $data;
    }

    public function getResipe($recipe_id){
        $recipe = $this->SelectRecipe->getResipe($recipe_id);
        return $recipe;
    }

    public function getMaterial($recipe_id){
        $material = $this->SelectRecipe->getMaterial($recipe_id);
        return $material;
    }

    public function getTejun($recipe_id){
        $tejun = $this->SelectRecipe->getTejun($recipe_id);
        return $tejun;
    }

    public function getFile($recipe_id){
        $file = $this->SelectRecipe->getFile($recipe_id);
        return $file;
    }

    public function getFile2($recipe_id,$count){
        $file = $this->SelectRecipe->getFile2($recipe_id,$count);
        return $file;
    }

    //新しいレシピ
    public function getNewRecipe(){
        $newRecipe = $this->SelectRecipe->getNewRecipe();
        return $newRecipe;
    }

    //ユーザーidからレシピ一覧を出す。
    public function getRecipeUser($id){
        $RecipeUser = $this->SelectRecipe->getRecipeUser($id);
        return $RecipeUser;
    }

    public function admingetRecipeList(){
        $data = $this->SelectRecipe->admingetRecipeList();
        return $data;
    }

}

?>