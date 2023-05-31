<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\upload;
use App\Models\UserLogic;
use App\Models\SelectSequence;
use App\Models\DeleteRecipe;
use App\Providers\RouteServiceProvider;

class UploadController extends Controller
{
    //

    private $Upload; //Upload モデル

    public function __construct() {
        // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        // モデルオブジェクトの生成
        $this->Upload = new Upload();
    }

    //Contributeではここを使う
    public function fileSave()
    {
        $getSequence = new SelectSequence();
        $update_id = $getSequence->getSequence1();
        $getRecipe_id = $getSequence->getSequence2();
        foreach($getRecipe_id as $id){
            $recipe_id =  $id->id;
        }
        foreach(session('login_user') as $data){
            $role = $data->role;
            $users_id = $data->id;
        }

        $scs_msg = array();
        $err_msg = array();

        if(isset($_FILES)){
            for($i = 0; $i < count($_FILES['file']['name']); $i++ ){
                if($i == 0 && $_FILES['file']['name'][0] == ""){
                    $err_msg['comp_image'] = '完成写真は必須項目です。';
                }
                //7回ループしたよ
                $filename = basename($_FILES['file']['name'][$i]);
                $tmp_path = $_FILES['file']['tmp_name'][$i];
                $file_err = $_FILES['file']['error'][$i];
                $filesize = $_FILES['file']['size'][$i];
                $upload_dir = 'images/';
                $save_filename = date('YmdHis') . $filename;
                $save_path = $upload_dir. $save_filename;
        
                //画像がなかったら埋め込む
                if($filesize == 0){
                    $filename = 'noimage.png';
                    $save_path = 'images/noimage.png';
                }
        
                if($filesize > 1048576 || $file_err == 2){
                    $err_msg[$i]['size'] = 'ファイルサイズは1MB未満にしてください。';
                }
        
                //拡張は画像形式か
                $allow_ext = array('jpg', 'jpeg', 'png');
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        
                if(count($err_msg) === 0){
                    //ファイルはあるかどうか？
                        if(is_uploaded_file($tmp_path) || $filename == 'noimage.png'){
                            if(move_uploaded_file($tmp_path, $save_path) || $filename == 'noimage.png'){
                                array_push($scs_msg, $filename . 'をアップしました。');
                
                                // DBに保存（ファイル名、ファイルパス）
                                $upload = new upload;
                                $result = $upload->fileSave($filename, $save_path, $recipe_id, $i);
                                if($result == '写真登録完了'){
                                    array_push($scs_msg, 'データベースに保存しました。');
                                } else{
                                    array_push($scs_msg, 'データベースへの保存が失敗しました。');

                                    return view('/Contribute',[
                                        'msg' => $scs_msg,
                                        'role' => $role,
                                    ]);
        
                                }
                            } else{
                                array_push($scs_msg, 'ファイルが保存できませんでした。');

                                return view('/Contribute',[
                                    'msg' => $scs_msg,
                                    'role' => $role,
                                ]);
                            }
                        } else {
                            array_push($scs_msg, 'ファイルが選択されていません。');

                            return view('/Contribute',[
                                'msg' => $scs_msg,
                                'role' => $role,
                            ]);
                        }
                }
            }
        }

        if(($_POST['title']) == ""){
            $err_msg['recipe']['title'] = 'タイトルは必須です。';
        }
        if(($_POST['comment']) == ""){
            $err_msg['recipe']['comment'] = 'コメントは必須です。';
        }
        if($_POST['procedure'][0] == ""){
            $err_msg['tejun'] = '一つ目は入力必須です。';
        }
        if($_POST['ma'][0] == ""){
            $err_msg['material']['ma'] = '材料の一つ目は入力必須です。';
        }
        if($_POST['qua'][0] == ""){
            $err_msg['material']['qua'] = '分量の一つ目は入力必須です。';
        }

        $title = $_POST['title'];
        $comment = $_POST['comment'];
        $level = $_POST['level'];

        if(count($err_msg) == 0){
            $recipeSave = new upload;
            $result = $recipeSave->recipeSave($title,$comment,$level,$users_id,$recipe_id); 

            // 以下ループ
  
            for ($i = 0; $i < count($_POST["ma"]); $i++) {

                //データが入ってなかったら
                if($_POST['ma'][$i] == ''){
                    break;
                }

                $material = $_POST['ma'][$i];
                $quanity = $_POST['qua'][$i];

                $materialSave = new upload;
                $result = $materialSave->materialSave($material, $quanity, $recipe_id); 
            }        
            for ($i = 0; $i < count($_POST["procedure"]); $i++) {

                //コメントが無かったら
                if($_POST['procedure'][$i] == ''){
                    break;
                }

                $proce_num = $i +1;
                $proce_com = $_POST['procedure'][$i];

                $procedureSave = new upload;
                $result = $procedureSave->procedureSave($proce_num, $proce_com, $recipe_id);
                
            }

            $msg = 'レシピテーブル登録できた！消してね！';

            return view('/Contribute_complete',[
                    'role' => $role,
                ]);
        }else{
            $msg = '登録できず！';
            return view('/Contribute',[
                'msg' => $msg,
                'role' => $role,
            ]);
            // $_SESSION['error'] = $err_msg;
            // header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }


    //ProfileEdit
    public function profileSave()
    {

        $error_count = 0;
        //コメントバリデーション
        if(empty($_POST['greeting'])){
            $greering_error['set'] = 'メッセージは必須入力です。';
            $error_count += 1;
        }elseif(100 < mb_strlen($_POST['password'], 'UTF-8') ){
            $greering_error['mb'] = 'メッセージは100文字以内で入力してください。';
            $error_count += 1;
        }

        //名前バリデーション
        if(empty($_POST['name'])){
            $name_error['name'] = '名前は必須入力です。';
            $error_count += 1;
        }

        //ニックネームバリデーション
        if(empty($_POST['nickname'])){
            $nickname_error['set'] = 'ニックネームは必須入力です。';
            $error_count += 1;
        } elseif( 10 < mb_strlen($_POST['nickname'], 'UTF-8') ) {
            $nickname_error['mb'] = 'ニックネームは10文字以内で入力してください。';
            $error_count += 1;
        }

        //emailバリデーション
        if(empty($_POST['email'])) {
            $email_error['set'] = 'メールアドレスは必須入力です。';
            $error_count += 1;
        }

        //passwordバリデーション
        if(empty($_POST['password'])){
            $password_error['set']= 'パスワードは必須入力です。';
            $error_count += 1;
        }elseif(5 > mb_strlen($_POST['password'], 'UTF-8') ){
            $password_error['mb'] = 'ニックネームは5文字以上で入力してください。';
            $error_count += 1;
        }

        //id取得
        if(session()->has('login_user')){
            foreach(session('login_user') as $data){
                $id = $data->id;
            }
        }

        if(session()->has('login_user')){
            foreach(session('login_user') as $data){
                $id = $data->id;
                $role = $data->role;
            }
    
            $getUsers = new UserLogic;
            $users = $getUsers->getUsers($id);

            foreach($users as $users){
                $regi_namedata = $users->prof_file_name;
                $regi_pathdata = $users->prof_file_path;
            }
        }


        if(isset($_FILES)){
            $filename = basename($_FILES['file']['name']);
            $tmp_path = $_FILES['file']['tmp_name'];
            $file_err = $_FILES['file']['error'];
            $filesize = $_FILES['file']['size'];
            $upload_dir = 'Profile_images/';
            $save_filename = date('YmdHis') . $filename;
            $save_path = $upload_dir. $save_filename;
        
            if($filesize > 1048576 || $file_err == 2){
                $error['size'] = 'ファイルサイズは1MB未満にしてください。';
                $error_count += 1;
            }

            //画像がなかったらループ終了
            if($filesize == 0){
                $filename = $regi_namedata;
                $save_path = $regi_pathdata;
            }
        
            //拡張は画像形式か
            $allow_ext = array('jpg', 'jpeg', 'png');
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    
    
            //UploadControllerを使っている。
            //ファイルはあるかどうか？
            if(is_uploaded_file($tmp_path) || $filename == $regi_namedata){
                if(move_uploaded_file($tmp_path, $save_path) || $filename == $regi_namedata){
    
                    //DBに保存（ファイル名、ファイルパス）
                    $upload = new upload;
                    $result = $upload->profileSave($filename, $save_path, $id);

                    if($error_count == 0){
                        $name = $_POST['name'];
                        $greeting = $_POST['greeting'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $nickname = $_POST['nickname'];
        
                        $updateuser = new UserLogic;
                        $result = $updateuser->updateUser($name,$greeting,$nickname,$email,$password,$id);
    
                        return redirect()->intended(RouteServiceProvider::PROFEDITCOMP);
                    }
                    else{
                        if(session()->has('login_user')){
                            foreach(session('login_user') as $data){
                                $id = $data->id;
                                $role = $data->role;
                            }
                    
                            $getUsers = new UserLogic;
                            $users = $getUsers->getUsers($id);
                        }
                        session(['greeting_error' => $greering_error]);
                        session(['name_error' => $name_error]);
                        session(['nickname_error' => $nickname_error]);
                        session(['email_error' => $email_error]);
                        session(['password_error' => $password_error]);
        
                        return view('/ProfileEdit',[
                            'users' => $users,
                            'role' => $role,
                            session('greeting_error'),
                            session('name_error'),
                            session('nickname_error'),
                            session('email_error'),
                            session('password_error'),
                        ]);
                    }

                } else{
                    $msg = 'アップロード失敗';

                    return view('/ProfileEdit',[
                        'msg' => $msg,
                        'users' => $users,
                        'role' => $role,
                    ]);
                }
            } else {
                if(session()->has('login_user')){
                    foreach(session('login_user') as $data){
                        $id = $data->id;
                        $role = $data->role;
                    }
            
                    $getUsers = new UserLogic;
                    $users = $getUsers->getUsers($id);
                }

                $msg = 'ファイルが選択されていません。';

                return view('/ProfileEdit',[
                    'msg' => $msg,
                    'users' => $users,
                    'role' => $role,
                ]);
            }
        }

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



    public function fileUpdate()
    {

        foreach(session('login_user') as $data){
            $role = $data->role;
        }
        $err_msg = [];
        $msg = [];
        $recipe_id = session('recipe_id');

        if(isset($_FILES)){
            for($i = 0; $i < count($_FILES['file']['name']); $i++ ){
                //7回ループしたよ
                $filename = basename($_FILES['file']['name'][$i]);
                $tmp_path = $_FILES['file']['tmp_name'][$i];
                $file_err = $_FILES['file']['error'][$i];
                $filesize = $_FILES['file']['size'][$i];
                $upload_dir = 'images/';
                $save_filename = date('YmdHis') . $filename;
                $save_path = $upload_dir. $save_filename;
        
                if($filesize > 1048576 || $file_err == 2){
                    $err_msg[$i]['size'] = 'ファイルサイズは1MB未満にしてください。';
                }
        
                //拡張は画像形式か
                $allow_ext = array('jpg', 'jpeg', 'png');
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        
                if(count($err_msg) === 0){
                    //ファイルはあるかどうか？
                        if(is_uploaded_file($tmp_path)){
                            if(move_uploaded_file($tmp_path, $save_path)){
                                // array_push($scs_msg, $filename . 'をアップしました。');
                
                                // DBに保存（ファイル名、ファイルパス）
                                $fileUpdate = new upload;
                                $result = $fileUpdate ->fileUpdate($filename, $save_path, $recipe_id, $i);
                                
                            } 
                        }
                }
            }
        }
         
        $title = $_POST['title'];
        $comment = $_POST['comment'];
        $level = $_POST['level'];

        $recipeUpdate = new upload;
        $result = $recipeUpdate->recipeUpdate($title,$comment,$level,$recipe_id);

        $delete = new DeleteRecipe;
        $result = $delete->deleteMaterial($recipe_id);
        $result = $delete->deleteProcedure($recipe_id);
        // 以下ループ
        for ($i = 0; $i < count($_POST["ma"]); $i++) {
        
            //画像がなかったらループ終了
            if($_POST['ma'][$i] == ''){
                break;
            }
        
            $material = $_POST['ma'][$i];
            $quanity = $_POST['qua'][$i];

            $materialSave = new upload;
            $result = $materialSave->materialSave($material, $quanity, $recipe_id); 
        }
        
        for ($i = 0; $i < count($_POST["procedure"]); $i++) {
        
        
            //画像がなかったらループ終了
            if($_POST['procedure'][$i] == ''){
                break;
            }
        
            $proce_num = $i +1;
            $proce_com = $_POST['procedure'][$i];
        
            $procedureSave = new upload;
            $result = $procedureSave->procedureSave($proce_num, $proce_com, $recipe_id);
            
        }

        session()->forget('recipe_id');

        return view('/Contribute_Edit_complete',[
            'role' => $role,
        ]);

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
