<?php
require_once(ROOT_PATH .'/Models/Db.php');

class SelectSequence extends Db {
    public function __construct($dbh = null){
    parent::__construct($dbh); 
    }


    /**
     * シーケンスを取得する
     */

     public function getSequence()
     {
        $result = False;
        $sql1 = "UPDATE sequence SET id=LAST_INSERT_ID(id+1)";
        $sql2 = "SELECT id from sequence";

        try{
            $sth1 = $this->dbh->prepare($sql1);
            $result = $sth1->execute();

            $sth2 = $this->dbh->prepare($sql2);
            $result = $sth2->execute();
            $recipe_id = $sth2->fetch();
            return $recipe_id['id'];
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
     }
}

?>