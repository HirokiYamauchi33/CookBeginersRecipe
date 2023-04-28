<?php
require_once(ROOT_PATH .'/Models/Db.php');

class DeleteRecipe extends Db {
    public function __construct($dbh = null){
    parent::__construct($dbh); 
    }


    /**
     * レシピ一覧を取得する
     */
    public function deleteRecipe($recipe_id)
    {
        $result = False;

        $sql1 = "DELETE FROM recipe WHERE recipe_id = ?";
        $sql2 = "DELETE FROM material WHERE recipe_id = ?";
        $sql3 = "DELETE FROM tejun WHERE recipe_id = ?";
        $sql4 = "DELETE FROM file WHERE recipe_id = ?";

        try{
            $sth1 = $this->dbh->prepare($sql1);
            $sth1 ->bindValue(1, $recipe_id);
            $result = $sth1->execute();
            $sth2 = $this->dbh->prepare($sql2);
            $sth2 ->bindValue(1, $recipe_id);
            $result = $sth2->execute();
            $sth3 = $this->dbh->prepare($sql3);
            $sth3 ->bindValue(1, $recipe_id);
            $result = $sth3->execute();
            $sth4 = $this->dbh->prepare($sql4);
            $sth4 ->bindValue(1, $recipe_id);
            $result = $sth4->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }

        
    }

    public function deleteMaterial($recipe_id)
    {
        $result = False;
        $sql = "DELETE FROM material WHERE recipe_id = ?";

        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $recipe_id);
            $result = $sth->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }     
    }

    public function deleteProcedure($recipe_id)
    {
        $result = False;
        $sql = "DELETE FROM tejun WHERE recipe_id = ?";

        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $recipe_id);
            $result = $sth->execute();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }     
    }
}



?>