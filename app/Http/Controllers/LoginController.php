<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserLogic;
use App\Models\SelectRecipe;
use App\Providers\RouteServiceProvider;


class LoginController extends Controller
{
    //

    private $UserLogic; //UserLogic モデル

    public function __construct() {
        // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
    }

    public function needData(){
        session()->forget('email');
        session()->forget('nickname');
        session()->forget('filename');
        session()->forget('filepath');
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $nickname = substr(str_shuffle($str), 0, 8);
        $filename = 'noimage.png';
        $filepath = 'Profile_images/noimage.png';

        session(['nickname'=>$nickname]);
        session(['filename'=>$filename]);
        session(['filepath'=>$filepath]);

        $userLogic = new UserLogic;
        $result = $userLogic->checkLogin();

        return view('/Register',[
            'result' => $result,
            session('nickname'),
            session('filename'),
            session('filepath'),
        ]);

    }

    public function newUser()
    {
        session()->forget('error');
        session()->forget('name');
        session()->forget('email');

        $errors = [];
        if (empty($_POST['name'])) {
            $errors['name'] = '氏名は必須入力です。';
        } elseif (10 < mb_strlen($_POST['name'])) {
            $errors['name'] = '10文字以内で入力してください';
        }

        //メールアドレス
        if (empty($_POST['email'])) {
            $errors['email'] = 'メールアドレスは必須入力です。';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'メールアドレスは正しくご入力ください。';
        }

        //パスワード
        if (empty($_POST['password'])) {
            $errors['password'] = 'パスワードは必須入力です。';
        } elseif (5 > mb_strlen($_POST['password'])) {
            $errors['password'] = '6文字以上で入力してください。';
        }

        //パスワード確認
        if (empty($_POST['conf_password'])) {
            $errors['conf_password'] = 'パスワード確認は必須入力です。';
        } elseif ($_POST['password'] !== $_POST['conf_password']) {
            $errors['conf_password'] = 'パスワードが一致しません。';
        }

        session(['name'=>$_POST['name']]);
        session(['email'=>$_POST['email']]);

        if(count($errors) !==0){
            session(['error'=>$errors]);
            return view('/Register',[
                session('error'),
                session('name'),
                session('email'),
            ]);
        }else{
            $newUser = new UserLogic;
            $result = $newUser->createUser(
                $_POST['name'],$_POST['email'],$_POST['password'],$_POST['nickname'],$_POST['filename'],$_POST['filepath']
            );

            // return view('/Register_complete');
            return redirect()->intended(RouteServiceProvider::REGICOMP);

        }
        // $user = $this->UserLogic->createUser($_POST);
        // $params = [
        //     'user' => $user
        // ];
    }
    
    public function login()
    {
        $err = [];
        session()->forget('mailmsg');
        session()->forget('pwmsg');
        session()->forget('email');
        session()->forget('err');

        if(empty($_POST['email'])){
            $err['email'] = "メールアドレスを入力してください。";
        }
        if(empty($_POST['password'])){
            $err['password'] = "パスワードを入力してください。";
        }  
        if(count($err) !== 0) {
            session(['email' => $_POST['email']]);
            session(['err' => $err]);
            return view('/Login',[
                session('email'),
                session('err'),
            ]);
        }

        $login = new UserLogic;
        $result = $login->loginUser($_POST['email'], $_POST['password']);

        if($result == true)
        {
            return redirect()->intended(RouteServiceProvider::INDEX);
        }
        else{
            return view('/Login',[
                session('mailmsg'),
                session('pwmsg'),
            ]);
        }
    }

    public function updatePassword(){
        session()->forget('email');
        session()->forget('error');
        session()->forget('msg');

        $errors = [];

        if (empty($_POST['email'])) {
            $errors['email'] = 'メールアドレスは必須入力です。';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'メールアドレスは正しくご入力ください。';
        }
    
        //パスワード
        if (empty($_POST['password'])) {
            $errors['password'] = 'パスワードは必須入力です。';
        } elseif (5 > mb_strlen($_POST['password'])) {
            $errors['password'] = '6文字以上で入力してください。';
        }

        //パスワード確認
        if (empty($_POST['conf_password'])) {
            $errors['conf_password'] = 'パスワード確認は必須入力です。';
        } elseif ($_POST['password'] !== $_POST['conf_password']) {
            $errors['conf_password'] = 'パスワードが一致しません。';
        }
    
        //エラーがあった場合の処理
        if (count($errors) !== 0) {
            session(['email' => $_POST['email']]);
            session(['error'=>$errors]);

            return view('/Password_Reset',[
                session('email'),
                session('error'),
            ]);

        }else{
            $email = $_POST['email'];
            $password = $_POST['password'];

            $updatePass = new UserLogic;
            $result = $updatePass->updatePassword($password,$email);
            return redirect()->intended(RouteServiceProvider::PWRSTCOMP);
        }
    }


    public function getUsers(){

        if(session()->has('login_user')){
            foreach(session('login_user') as $data){
                $id = $data->id;
                $role = $data->role;
            }
    
            $getUsers = new UserLogic;
            $user = $getUsers->getUsers($id);
    
            return view('Profile',[
                'user' => $user,
                'role' => $role,
            ]);
        }else{
            return redirect()->intended(RouteServiceProvider::LOGIN);
        };
    }

    public function getEditUsers(){

        if(session()->has('login_user')){
            foreach(session('login_user') as $data){
                $id = $data->id;
                $role = $data->role;
            }
    
            $getUsers = new UserLogic;
            $users = $getUsers->getUsers($id);
    
            return view('ProfileEdit',[
                'users' => $users,
                'role' => $role,
            ]) ;
        }else{
            return redirect()->intended(RouteServiceProvider::LOGIN);
        };
    }

    
    // public function verifyLogin()
        // {

        //     $userLogic = new UserLogic;
        //     $result = $userLogic->checkLogin();
        //     session(['result' => $result]);

        //     return view('/index',[
        //         session('result'),
        //     ]);
    // }

    
    public function logout()
    {
        $user = $this->UserLogic->logoutAcc();
    }

    public function setToken()
    {
        $rand_num = $this->UserLogic->setToken();
    }

    public function updateUser($name,$greeting,$nickname,$email,$password,$id)
    {
        $user = $this->UserLogic->updateUser($name,$greeting,$nickname,$email,$password,$id);
        return $user;
    }

    public function admingetUser(){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/admin';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            $admingetUsers = new UserLogic;
            $userdata = $admingetUsers->admingetUser();

            if(session()->has('login_user')){
                foreach(session('login_user') as $data){
                    $role = $data->role;
                }
            }

            return view('admin_userlist',[
                    'userdata' => $userdata,
                    'role' => $role,
            ]);
        }
    }

    public function adminDeleteUser($id){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/admin_userlist';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            $adminDeleteUsers = new UserLogic;
            $user = $adminDeleteUsers->admindeleteUser($id);

            if(session()->has('login_user')){
                foreach(session('login_user') as $data){
                    $role = $data->role;
                }
            }
            return view('admin_delete',[
                'role' => $role,
            ]);
        }
    }

    public function del_flg()
    {
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/Profile';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            $userLogic = new UserLogic;
            $result = $userLogic->checkLogin();
    
            if(session()->has('login_user')){
                foreach(session('login_user') as $data){
                    $id = $data->id;
                }
            }
            $del_flg = new UserLogic;
            $user = $del_flg->del_flg($id);
    
            return view('Leave',[
                'result' => $result,
            ]);
        }
    }
}
