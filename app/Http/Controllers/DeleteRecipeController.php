<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\SelectRecipe;
use App\Models\DeleteRecipe;


class DeleteRecipeController extends Controller
{
     //

     private $DeleteRecipe;

     public function __construct() {
         // リクエストパラメータの取得
         // $this->request['get'] = $_GET;
         $this->request['post'] = $_POST;
 
         // モデルオブジェクトの生成
         $this->DeleteRecipe = new DeleteRecipe();
     }



 
     public function deleteRecipe($recipe_id){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/admin_contributelist';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            $selectRecipe = new SelectRecipe;
            $file = $selectRecipe->getFile($recipe_id);
    
            $success_count = 0;
            $error_count = 0;
            $noimage ='images/noimage.png';
    
            foreach($file as $data){
                $file_path = $data->file_path;
                if($file_path !== $noimage){
                    if(unlink($file_path)){
                        $success_count = $success_count + 1;
                    }else{
                        $error_count = $error_count + 1;
                    }
                }
            }
            //recipe_idからレシピを削除
    
            if($error_count == 0){
                $deleteRecipe = new DeleteRecipe;
                $result = $deleteRecipe->deleteRecipe($recipe_id); 
    
                foreach(session('login_user') as $data){
                    $role = $data->role;
                }
        
                return view('admin_deleteRecipe',[
                    'role' => $role,
                ]);
            }else{
                foreach(session('login_user') as $data){
                    $role = $data->role;
                }
    
                $msg =  'レシピ削除できていませんよ';
                return view('admin_deleteRecipe',[
                    'role' => $role,
                    'msg' => $msg,
                ]);
            }
        }
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
