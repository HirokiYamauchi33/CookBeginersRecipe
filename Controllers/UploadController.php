<?php
require_once(ROOT_PATH .'/Models/Upload.php');

class UploadController {
    private $Upload; //Upload モデル

    public function __construct() {
        // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        // モデルオブジェクトの生成
        $this->Upload = new Upload();
    }

    public function fileSave($filename, $save_path, $recipe_id ,$i)
    {
        $result = $this->Upload->fileSave($filename, $save_path, $recipe_id ,$i);
        return $result;
    }

    public function profileSave($filename, $save_path, $id)
    {
        $result = $this->Upload->profileSave($filename, $save_path, $id);
        return $result;
    }

    public function recipeSave($title,$comment, $level, $users_id, $recipe_id)
    {
        $result = $this->Upload->recipeSave($title,$comment, $level, $users_id, $recipe_id);
        return $result;

    }

    public function materialSave($material, $quanity, $recipe_id)
    {
        $result = $this->Upload->materialSave($material, $quanity, $recipe_id);
        return $result;
    }

    public function procedureSave($proce_num, $proce_com, $recipe_id)
    {
        $result = $this->Upload->procedureSave($proce_num, $proce_com, $recipe_id);
        return $result;
    }

    public function fileUpdate($filename, $save_path, $recipe_id ,$i)
    {
        $result = $this->Upload->fileUpdate($filename, $save_path, $recipe_id ,$i);
        return $result;
    }

    public function recipeUpdate($title,$comment, $level, $recipe_id)
    {
        $result = $this->Upload->recipeUpdate($title,$comment, $level, $recipe_id);
        return $result;

    }

    public function materialUpdate($material, $quanity, $recipe_id)
    {
        $result = $this->Upload->materialUpdate($material, $quanity, $recipe_id);
        return $result;
    }

    public function procedureUpdate($proce_com, $recipe_id, $proce_num)
    {
        $result = $this->Upload->procedureUpdate($proce_com, $recipe_id, $proce_num);
        return $result;
    }
}

?>