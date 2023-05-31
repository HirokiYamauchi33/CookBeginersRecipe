<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SelectRecipe extends Model
{
    use HasFactory;

    // public function __construct($dbh = null){
    //     parent::__construct($dbh); 
    //     }
    
    
    /**
     * レシピ一覧を取得する
     */
    public function getRecipeList($level)
    {

        $recipeList =
        DB::table('recipe')
        ->select(
            'recipe.title as title',
            'recipe.comment as comment',
            'file.file_path as comp_img',
            'users.nickname as nickname',
            'users.prof_file_path as user_img',
            'recipe.recipe_id as recipe_id',
        )
        ->from('recipe')
        ->join('users as users','recipe.users_id', '=', 'users.id')
        ->join('file as file','recipe.recipe_id', '=', 'file.recipe_id')
        ->whereRaw('recipe.level = ?',[$level])
        ->where('file.tejun_id','=','0')
        ->orderBy('file.id','desc')
        ->get();

        return $recipeList;

        // $result = False;
        // $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img, users.nickname AS nickname, users.prof_file_path AS user_img, recipe.recipe_id AS recipe_id
        // from recipe
        // INNER JOIN users ON recipe.users_id = users.id 
        // INNER JOIN file ON recipe.recipe_id = file.recipe_id
        // WHERE recipe.level =?
        // GROUP BY file.recipe_id
        // ORDER BY file.id ASC ";
        // recipe.level AS level, 
            // try{
            //     $sth = $this->dbh->prepare($sql);
            //     $sth ->bindValue(1, $level);
            //     $result = $sth->execute();
            //     $data = $sth->fetchAll();
            //     return $data;
            // }catch(\Exception $e){
            //     echo $e->getMessage();
            //     return $result;
            // }
    }
    /**
     * レシピ詳細を取得する
     *  (resipe)
     */
    public function getRecipe($recipe_id)
    {
        $Recipe =
        DB::table('recipe')
        ->select(
            'recipe.title as title',
            'recipe.comment as comment',
            'recipe.level as level',
            'file.file_path as comp_img',
            'users.nickname as nickname',
            'users.prof_file_path as user_img'
        )
        ->from('recipe')
        ->join('users as users','recipe.users_id', '=', 'users.id')
        ->join('file as file','recipe.recipe_id', '=', 'file.recipe_id')
        ->whereRaw('recipe.recipe_id = ?',[$recipe_id])
        ->where('file.tejun_id','=','0')
        ->orderBy('file.id','desc')
        ->get();

        return $Recipe;

        // $result = False;
            // $sql = "SELECT recipe.title AS title, recipe.comment AS comment, recipe.level, file.file_path AS comp_img, users.nickname AS nickname, users.prof_file_path AS user_img
            // from recipe
            // INNER JOIN users ON recipe.users_id = users.id 
            // INNER JOIN file ON recipe.recipe_id = file.recipe_id
            // WHERE recipe.recipe_id = ?
            // GROUP BY file.recipe_id
            // ORDER BY file.id DESC LIMIT 1";
            
            // try{
            //     $sth = $this->dbh->prepare($sql);
            //     $sth ->bindValue(1, $recipe_id);
            //     $result = $sth->execute();
            //     $recipe = $sth->fetchAll();
            //     return $recipe;
            // }catch(\Exception $e){
            //     echo $e->getMessage();
            //     return $result;
            // }
    }


    /**
     * レシピ詳細を取得する
     * (material)
     */
    public function getMaterial($recipe_id)
    {

        $Material =
        DB::table('material')
        ->select(
            'material',
            'quanity',
        )
        ->from('material')
        ->whereRaw('recipe_id = ?',[$recipe_id])
        ->get();

        return $Material;

        // $result = False;
            // $sql = "SELECT material,quanity FROM material WHERE recipe_id = ?";

            // try{
            //     $sth = $this->dbh->prepare($sql);
            //     $sth ->bindValue(1, $recipe_id);
            //     $result = $sth->execute();
            //     $material = $sth->fetchAll();
            //     return $material;
            // }catch(\Exception $e){
            //     echo $e->getMessage();
            //     return $result;
            // }
    }

    /**
     * レシピ詳細を取得する
     * (tejun)
     */
    public function getTejun($recipe_id)
    {
        $Tejun =
        DB::table('tejun')
        ->select('proce_com')
        ->from('tejun')
        ->whereRaw('recipe_id = ?',[$recipe_id])
        ->orderBy('proce_num','ASC')
        ->get();

        return $Tejun;
        // $result = False;
            // $sql = "SELECT proce_com FROM tejun WHERE tejun.recipe_id =? ORDER BY tejun.proce_num ASC";
            // try{
            //     $sth = $this->dbh->prepare($sql);
            //     $sth ->bindValue(1, $recipe_id);
            //     $result = $sth->execute();
            //     $tejun = $sth->fetchAll();
            //     return $tejun;
            // }catch(\Exception $e){
            //     echo $e->getMessage();
            //     return $result;
            // }
    }

    /**
     * レシピ詳細を取得する
     * (file)
     */
    public function getFile($recipe_id)
    {
        $file = 
        DB::table('file')
        ->select('*')
        ->from('file')
        ->whereRaw('recipe_id = ?',[$recipe_id])
        ->get();

        return $file;
        // $result = False;
            // $sql = "SELECT * FROM file WHERE recipe_id =?";
            // try{
            //     $sth = $this->dbh->prepare($sql);
            //     $sth ->bindValue(1, $recipe_id);
            //     $result = $sth->execute();
            //     $file = $sth->fetchALL();
            //     return $file;
            // }catch(\Exception $e){
            //     echo $e->getMessage();
            //     return $result;
            // }
    }

    /**
     * 完成画像以外を取得する
     * (file)
     */
    public function getFile2($recipe_id,$count)
    {
        $getFile =
        DB::table('file')
        ->select('file_path')
        ->from('file')
        ->whereRaw('recipe_id = ?',[$recipe_id])
        ->orderBy('id','asc')
        ->limit($count)
        ->offset(1)
        ->get();

        return $getFile;
        // $sql = "SELECT file_path FROM file WHERE recipe_id = ? ORDER BY id ASC LIMIT ? OFFSET 1";
        // try{
            //     $sth = $this->dbh->prepare($sql);
            //     $sth ->bindValue(1, $recipe_id);
            //     $sth ->bindValue(2, $count,PDO::PARAM_INT);
            //     $result = $sth->execute();
            //     $file = $sth->fetchALL();
            //     return $file;
            // }catch(\Exception $e){
            //     echo $e->getMessage();
            //     return $result;
            // }
    }

    /** 
     * 最新のレシピを表示させる
    */
    public function getNewRecipe()
    {
        $newRecipeList =
        DB::table('recipe')
        ->select(
            'recipe.title',
            'recipe.comment',
            'file.file_path',
            'users.nickname',
            'users.prof_file_path',
            'recipe.recipe_id'
        )
        ->from('recipe')
        ->join('users as users','recipe.users_id', '=', 'users.id')
        ->join('file as file','recipe.recipe_id', '=', 'file.recipe_id')
        ->where('file.tejun_id','=','0')
        ->orderBy('file.id','desc')
        ->limit(3)
        ->get();

        session(['test'=>$newRecipeList]);
        return $newRecipeList;
        // $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img,
            //  users.nickname AS nickname, users.prof_file_path AS user_img, recipe.recipe_id AS recipe_id
            // from recipe
            // INNER JOIN users ON recipe.users_id = users.id 
            // INNER JOIN file ON recipe.recipe_id = file.recipe_id
            // GROUP BY file.recipe_id
            // ORDER BY file.id DESC LIMIT 3";

            // try {
            //     $sth = $this->dbh->prepare($sql);
            //     $result = $sth->execute();
            //     $newRecipe = $sth->fetchALL();
            //     return $newRecipe;
            // } catch (\Exception $e) {
            //     echo $e->getMessage();
            //     return $result;
            // }

    }

    /** 
     * レシピの一覧を取得する
     * （ユーザーIDでの取得）
    */
    public function getRecipeUser($id)
    {

        $getRecipeUser = DB::table('recipe')
        ->select(
            'recipe.title as title',
            'recipe.comment as comment',
            'file.file_path as comp_img',
            'recipe.level as recipe_level',
            'recipe.recipe_id as recipe_id',
            'users.id as users_id'
        )
        ->from('recipe')
        ->join('users as users','recipe.users_id', '=', 'users.id')
        ->join('file as file','recipe.recipe_id', '=', 'file.recipe_id')
        ->where('users.id','=',$id)
        ->where('file.tejun_id','=','0')
        ->orderBy('file.id','ASC')
        ->get();

        // $result = False;
            // $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img, recipe.level AS recipe_level, recipe.recipe_id AS recipe_id, users.id AS users_id
            // from recipe
            // INNER JOIN users ON recipe.users_id = users.id 
            // INNER JOIN file ON recipe.recipe_id = file.recipe_id
            // WHERE users.id = ?
            // GROUP BY file.recipe_id
            // ORDER BY file.id ASC ";
            // try {
            //     $sth = $this->dbh->prepare($sql);
            //     $sth->bindValue(1, $id);
            //     $result = $sth->execute();
            //     $data = $sth->fetchAll();
            //     return $data;
            // } catch (\Exception $e) {
            //     echo $e->getMessage();
            //     return $result;
            // }

        return $getRecipeUser;

    }

    /**
     * レシピ一覧を取得する
     */
    public function admingetRecipeList()
    {

        $admingetRecipe =
        DB::table('recipe')
        ->select(
            'recipe.title as title',
            'recipe.comment as comment',
            'file.file_path as comp_img',
            'users.nickname as nickname',
            'users.prof_file_path as user_img',
            'recipe.recipe_id as recipe_id'
        )
        ->from('recipe')
        ->join('users as users','recipe.users_id', '=', 'users.id')
        ->join('file as file','recipe.recipe_id', '=', 'file.recipe_id')
        ->where('file.tejun_id','=','0')
        ->orderBy('file.id','ASC')
        ->get();

        return $admingetRecipe;

        // $result = False;
        // $sql = "SELECT recipe.title AS title, recipe.comment AS comment, file.file_path AS comp_img, users.nickname AS nickname, users.prof_file_path AS user_img, recipe.recipe_id AS recipe_id
        // from recipe
        // INNER JOIN users ON recipe.users_id = users.id 
        // INNER JOIN file ON recipe.recipe_id = file.recipe_id
        // GROUP BY file.recipe_id
        // ORDER BY file.id ASC ";
        // recipe.level AS level, 
        // try{
        //     $sth = $this->dbh->prepare($sql);
        //     $result = $sth->execute();
        //     $data = $sth->fetchAll();
        //     return $data;
        // }catch(\Exception $e){
        //     echo $e->getMessage();
        //     return $result;
        // }
    }
}
