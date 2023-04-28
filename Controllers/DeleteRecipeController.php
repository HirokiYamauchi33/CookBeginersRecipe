<?php
require_once(ROOT_PATH .'/Models/DeleteRecipe.php');

class DeleteRecipeController {

    private $DeleteRecipe;

    public function __construct() {
        // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        // モデルオブジェクトの生成
        $this->DeleteRecipe = new DeleteRecipe();
    }

    public function deleteRecipe($recipe_id){
        $deleteRecipe = $this->DeleteRecipe->deleteRecipe($recipe_id);
        return $deleteRecipe;
    }

    public function deleteMaterial($recipe_id){
        $deleteRecipe = $this->DeleteRecipe->deleteMaterial($recipe_id);
        return $deleteRecipe;
    }

    public function deleteProcedure($recipe_id){
        $deleteRecipe = $this->DeleteRecipe->deleteProcedure($recipe_id);
        return $deleteRecipe;
    }

}