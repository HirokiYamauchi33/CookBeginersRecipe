<?php
require_once(ROOT_PATH .'/Models/Db.php');

class SelectRecipe extends Db {
    public function __construct($dbh = null){
    parent::__construct($dbh); 
    }


    /**
     * レシピ一覧を取得する
     */
    public function getRecipeList($level)
    {
        $result = False;
        $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img, users.nickname AS nickname, users.prof_file_path AS user_img, recipe.recipe_id AS recipe_id
        from recipe
        INNER JOIN users ON recipe.users_id = users.id 
        INNER JOIN file ON recipe.recipe_id = file.recipe_id
        WHERE recipe.level =?
        GROUP BY file.recipe_id
        ORDER BY file.id ASC ";
        // recipe.level AS level, 
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $level);
            $result = $sth->execute();
            $data = $sth->fetchAll();
            return $data;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }
    /**
     * レシピ詳細を取得する
     *  (resipe)
     */
    public function getResipe($recipe_id)
    {
        $result = False;
        $sql = "SELECT recipe.title AS title, recipe.comment AS comment, recipe.level, file.file_path AS comp_img, users.nickname AS nickname, users.prof_file_path AS user_img
        from recipe
        INNER JOIN users ON recipe.users_id = users.id 
        INNER JOIN file ON recipe.recipe_id = file.recipe_id
        WHERE recipe.recipe_id = ?
        GROUP BY file.recipe_id
        ORDER BY file.id DESC LIMIT 1";
        
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $recipe_id);
            $result = $sth->execute();
            $recipe = $sth->fetchAll();
            return $recipe;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }


    /**
     * レシピ詳細を取得する
     * (material)
     */
    public function getMaterial($recipe_id)
    {
        $result = False;
        $sql = "SELECT material,quanity FROM material WHERE recipe_id = ?";

        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $recipe_id);
            $result = $sth->execute();
            $material = $sth->fetchAll();
            return $material;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    /**
     * レシピ詳細を取得する
     * (tejun)
     */
    public function getTejun($recipe_id)
    {
        $result = False;
        $sql = "SELECT proce_com FROM tejun WHERE tejun.recipe_id =? ORDER BY tejun.proce_num ASC";
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $recipe_id);
            $result = $sth->execute();
            $tejun = $sth->fetchAll();
            return $tejun;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    /**
     * レシピ詳細を取得する
     * (file)
     */
    public function getFile($recipe_id)
    {
        $result = False;
        $sql = "SELECT * FROM file WHERE recipe_id =?";
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $recipe_id);
            $result = $sth->execute();
            $file = $sth->fetchALL();
            return $file;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    /**
     * 完成画像以外を取得する
     * (file)
     */
    public function getFile2($recipe_id,$count)
    {
        $result = False;
        $sql = "SELECT file_path FROM file WHERE recipe_id = ? ORDER BY id ASC LIMIT ? OFFSET 1";
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $recipe_id);
            $sth ->bindValue(2, $count,PDO::PARAM_INT);
            $result = $sth->execute();
            $file = $sth->fetchALL();
            return $file;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    /** 
     * 最新のレシピを表示させる
    */
    public function getNewRecipe()
    {
        $result = False;
        $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img, users.nickname AS nickname, users.prof_file_path AS user_img, recipe.recipe_id AS recipe_id
        from recipe
        INNER JOIN users ON recipe.users_id = users.id 
        INNER JOIN file ON recipe.recipe_id = file.recipe_id
        GROUP BY file.recipe_id
        ORDER BY file.id DESC LIMIT 3";
        try {
            $sth = $this->dbh->prepare($sql);
            $result = $sth->execute();
            $newRecipe = $sth->fetchALL();
            return $newRecipe;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return $result;
        }

    }

    /** 
     * レシピの一覧を取得する
     * （ユーザーIDでの取得）
    */
    public function getRecipeUser($id)
    {
        $result = False;
        $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img, recipe.level AS recipe_level, recipe.recipe_id AS recipe_id, users.id AS users_id
        from recipe
        INNER JOIN users ON recipe.users_id = users.id 
        INNER JOIN file ON recipe.recipe_id = file.recipe_id
        WHERE users.id = ?
        GROUP BY file.recipe_id
        ORDER BY file.id ASC ";
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(1, $id);
            $result = $sth->execute();
            $data = $sth->fetchAll();
            return $data;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return $result;
        }

    }

    /**
     * レシピ一覧を取得する
     */
    public function admingetRecipeList()
    {
        $result = False;
        $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img, users.nickname AS nickname, users.prof_file_path AS user_img, recipe.recipe_id AS recipe_id
        from recipe
        INNER JOIN users ON recipe.users_id = users.id 
        INNER JOIN file ON recipe.recipe_id = file.recipe_id
        GROUP BY file.recipe_id
        ORDER BY file.id ASC ";
        // recipe.level AS level, 
        try{
            $sth = $this->dbh->prepare($sql);
            $result = $sth->execute();
            $data = $sth->fetchAll();
            return $data;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }


}



?>