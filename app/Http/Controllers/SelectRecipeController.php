<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SelectRecipe;
use App\Models\UserLogic;
use App\Providers\RouteServiceProvider;

class SelectRecipeController extends Controller
{
    //

    private $SelectRecipe;

    public function __construct() {
                // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
    }

    public function getRecipeList($level){
        
        $userLogic = new UserLogic;
        $result = $userLogic->checkLogin();

        $getRecipeList = new SelectRecipe;
        $recipeList = $getRecipeList->getRecipeList($level);
        return view('/Level_Recipe',[
            'level' => $level,
            'result' => $result,
            'recipeList' => $recipeList,
        ]);
    }




    public function getAll($recipe_id){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/Contribute_List';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            if(session()->has('login_user')){
                foreach(session('login_user') as $data){
                    $id = $data->id;
                    $role = $data->role;
                }
            }
            $getAll = new SelectRecipe;
            $recipe = $getAll->getRecipe($recipe_id);
            $material = $getAll->getMaterial($recipe_id);
            $tejun = $getAll->getTejun($recipe_id);
    
            $count = 6;
            $getFile = $getAll->getFile2($recipe_id,$count);
    
            session(['recipe_id'=>$recipe_id]);
    
            return view('/Contribute_Edit',[
                'role' => $role,
                'getRecipe' => $recipe,
                'getMaterial' => $material,
                'getTejun' => $tejun,
                'getFile' => $getFile
            ]);
        }
    }

    public function getDetail($recipe_id){

        $userLogic = new UserLogic;
        $result = $userLogic->checkLogin();

        $getDetail = new SelectRecipe;
        $recipe = $getDetail->getRecipe($recipe_id);
        $material = $getDetail->getMaterial($recipe_id);
        $tejun = $getDetail->getTejun($recipe_id);

        $count = count($tejun);
        $getFile = $getDetail->getFile2($recipe_id,$count);

        return view('/RecipeDetail',[
            'result' => $result,
            'getRecipe' => $recipe,
            'getMaterial' => $material,
            'count' => $count,
            'getTejun' => $tejun,
            'getFile' => $getFile
        ]);

    }

    public function getFile($recipe_id){
        $file = $this->SelectRecipe->getFile($recipe_id);
        return $file;
    }

    public function getFile2($recipe_id,$count){
        $file = $this->SelectRecipe->getFile2($recipe_id,$count);
        return $file;
    }



    public function a(){
       return redirect()->intended(RouteServiceProvider::INDEX);
    }

    //新規投稿されたレシピ
    public function getNewRecipe(){
        $getNewRecipe = new SelectRecipe;
        $newRecipeList = $getNewRecipe->getNewRecipe();

        $userLogic = new UserLogic;
        $result = $userLogic->checkLogin();

        return view('/index',[
            'newRecipeList' => $newRecipeList,
            'result' => $result,
        ]);
    }




    //ユーザーidからレシピ一覧を出す。
    public function getRecipeUser(){
        if(session()->has('login_user')){
            foreach(session('login_user') as $data){
                $id = $data->id;
                $role = $data->role;
            }
            $getRecipeUser = new SelectRecipe;
            $RecipeUser = $getRecipeUser->getRecipeUser($id);
            return view('/Contribute_List',[
                'userRecipeList' => $RecipeUser,
                'role' => $role,
            ]);
        }else{
            return redirect()->intended(RouteServiceProvider::LOGIN);
        }
    }

    public function admingetRecipeList(){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/admin';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            $admingetRecipeList = new SelectRecipe;
            $recipeList = $admingetRecipeList->admingetRecipeList();

            if(session()->has('login_user')){
                foreach(session('login_user') as $data){
                    $role = $data->role;
                }
            }
            return view('/admin_contributelist',[
                'recipeList' => $recipeList,
                'role' => $role,
            ]);
        }
    }
}
