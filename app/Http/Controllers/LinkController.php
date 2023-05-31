<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserLogic;
use App\Providers\RouteServiceProvider;

class LinkController extends Controller
{
    //ログインページへ
    public function loginLink(){

        $userLogic = new UserLogic;
        $result = $userLogic->checkLogin();
        session()->forget('email');
        return view('/Login',[
            'result' => $result,
        ]);
    }

    public function regiCompLink(){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/Register';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            $userLogic = new UserLogic;
            $result = $userLogic->checkLogin();
            return view('/Register_complete',[
                'result' => $result,
            ]);
        }
    }

    public function passResetLink(){
        return view('/Password_Reset');
    }

    public function pwResetCompLink(){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/Password_Reset';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::INDEX); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            return view('/Password_Reset_complete');
        }
    }

    public function logoutLink(){
        if(session()->has('login_user')){
            session()->forget('login_user');
            $userLogic = new UserLogic;
            $result = $userLogic->checkLogin();
            
            return view('/Logout',[
                'result' => $result,
            ]);
        }else{
            return redirect()->intended(RouteServiceProvider::INDEX);
        }
    }

    public function profEditCompLink(){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/ProfileEdit';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::LOGIN); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            foreach(session('login_user') as $data){
                $role = $data->role;
            }
            return view('/ProfileEdit_complete',[
                'role' => $role,
            ]);
        }
    }

    public function contributeLink(){
        if(session()->has('login_user')){
            foreach(session('login_user') as $data){
                $role = $data->role;
            }
            return view('/Contribute',[
                'role' => $role,
            ]);
        }else{
            return redirect()->intended(RouteServiceProvider::LOGIN);
        }
    }

    public function contributeCompLink(){
        $referer = url()->previous(); // 直前にアクセスしてきたURL
        $url = 'http://localhost/Contribute';

        if($referer !== $url){ // 直前にアクセスしてきたURLと変数$urlの中身が一緒ではなかったら
            return redirect()->intended(RouteServiceProvider::LOGIN); // header関数を使用した直後に記載しないとページの下まで処理をし終えてから画面遷移します。忘れず絶対に書きましょう。
        }else{
            foreach(session('login_user') as $data){
                $role = $data->role;
            }
            return view('/Contribute_complete',[
                'role' => $role,
            ]);
        }
    }

    public function adminLink(){
        if(session()->has('login_user')){
            foreach(session('login_user') as $data){
                $id = $data->id;
                $role = $data->role;
            }
            if($role !== 1){
                return redirect()->intended(RouteServiceProvider::INDEX);
            }else{
                return view('/admin',[
                    'role' => $role,
                ]);
            }
        }else{
            return redirect()->intended(RouteServiceProvider::LOGIN);
        }

    }
}
