<?php
require_once(ROOT_PATH .'/Models/Db.php');


class Upload extends Db {
    public function __construct($dbh = null){
    parent::__construct($dbh); 
    }

    public function profileSave($filename, $save_path, $id)
    {
        $result = False;
        

        $sql = "UPDATE users SET prof_file_name=?, prof_file_path=? WHERE id=?";
        
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $filename);
            $sth ->bindValue(2, $save_path);
            $sth ->bindValue(3, $id);
            $result = $sth->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    /**
     * ファイルデータを保存
     * @param string $filename ファイル名
     * @param string $save_path 保存先パス
     * @param int $recipe_id シーケンス番号
     * @return bool $result
     */
    public function fileSave($filename, $save_path, int $recipe_id ,$i)
    {
        $result = False;
        $sql = "INSERT INTO file (file_name, file_path, recipe_id, tejun_id) VALUE (?, ?, ?, ?)";
        
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $filename);
            $sth ->bindValue(2, $save_path);
            $sth ->bindValue(3, (int)$recipe_id);
            $sth ->bindValue(4, $i);
            $result = $sth->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    public function recipeSave($title,$comment, $level, $users_id, $recipe_id)
    {
        $result = False;
        $recipeInsert = "INSERT INTO recipe(title, comment, level, users_id, recipe_id) VALUE(?, ?, ?, ?, ?)";

        try{
            $sth = $this->dbh->prepare($recipeInsert);
            $sth ->bindValue(1, $title);
            $sth ->bindValue(2, $comment);
            $sth ->bindValue(3, $level);
            $sth ->bindValue(4, $users_id);
            $sth ->bindValue(5, $recipe_id);
            $result = $sth->execute();

            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    public function materialSave($material, $quanity, $recipe_id)
    {
        $result = False;
        $materialInsert = "INSERT INTO material (material, quanity, recipe_id) VALUE(?, ?, ?)";

        try{
        $sth = $this->dbh->prepare($materialInsert);
        $sth ->bindValue(1, $material);
        $sth ->bindValue(2, $quanity);
        $sth ->bindValue(3, $recipe_id);
        $result = $sth->execute();
    }catch(\Exception $e){
        echo $e->getMessage();
        return $result;
    }
    }

    public function procedureSave($proce_num, $proce_com, $recipe_id)
    {
        $result = False;
        $procedureInsert = "INSERT INTO tejun (proce_num, proce_com, recipe_id) VALUE(?, ?, ?)";

        try{
            $sth = $this->dbh->prepare($procedureInsert);
            $sth ->bindValue(1, $proce_num);
            $sth ->bindValue(2, $proce_com);
            $sth ->bindValue(3, $recipe_id);
            $result = $sth->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

     /**
     * ファイルデータをアップデート
     * @param string $filename ファイル名
     * @param string $save_path 保存先パス
     * @param int $recipe_id シーケンス番号
     * @return bool $result
     */
    public function fileUpdate($filename, $save_path, int $recipe_id ,$i)
    {
        $result = False;
        $sql = "UPDATE file SET file_name =? , file_path =? WHERE recipe_id =? AND tejun_id =? ";
        
        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $filename);
            $sth ->bindValue(2, $save_path);
            $sth ->bindValue(3, (int)$recipe_id);
            $sth ->bindValue(4, $i);
            $result = $sth->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    public function recipeUpdate($title,$comment, $level, $recipe_id)
    {
        $result = False;
        $recipeInsert = "UPDATE recipe SET title = ?, comment = ?, level = ? WHERE recipe_id = ?";

        try{
            $sth = $this->dbh->prepare($recipeInsert);
            $sth ->bindValue(1, $title);
            $sth ->bindValue(2, $comment);
            $sth ->bindValue(3, $level);
            $sth ->bindValue(4, $recipe_id);
            $result = $sth->execute();

            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    public function procedureUpdate($proce_com, $recipe_id, $proce_num)
    {
        $result = False;
        $procedureInsert = "UPDATE tejun SET proce_com = ? WHERE recipe_id = ? AND proce_num = ?";

        try{
            $sth = $this->dbh->prepare($procedureInsert);
            $sth ->bindValue(1, $proce_com);
            $sth ->bindValue(2, $recipe_id);
            $sth ->bindValue(3, $proce_num);
            $result = $sth->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

}

?>