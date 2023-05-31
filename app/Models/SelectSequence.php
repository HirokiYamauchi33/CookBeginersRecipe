<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SelectSequence extends Model
{
    use HasFactory;

    // public function __construct($dbh = null){
    //     parent::__construct($dbh); 
    //     }
    
    
    /**
     * シーケンスを取得する
     */

    public function getSequence1()
    {
        $update_id =
        DB::table('sequence')
        ->increment('id');
        // $sql1 = "UPDATE sequence SET id=LAST_INSERT_ID(id+1)";

    }

    public function getSequence2()
    {
        $recipe_id =
        DB::table('sequence')
        ->select('id')
        ->get();
        // $recipe_id = "SELECT id from sequence";

        return $recipe_id;
    }
}
