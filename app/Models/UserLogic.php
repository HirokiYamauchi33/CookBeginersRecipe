<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserLogic extends Model
{
    use HasFactory;

    // private $table = "users";
    // public function __construct($dbh = null){
    // parent::__construct($dbh); 
    // }

    /**
     * ユーザー情報をDBに登録する
     */
    public function createUser($name,$email,$password,$nickname,$filename,$filepath){
        $hash = Hash::make($password);

        $user = DB::table('users')
        ->insertOrIgnore([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'nickname' => $nickname,
            'prof_file_name' => $filename,
            'prof_file_path' => $filepath,
        ]);

        return $user;

    }

    public function loginUser($email,$password)
    {
        $result = false;
        //ユーザデータをemailから検索
        $user = 
        DB::table('users')
        ->select('*')
        ->from('users')
        ->whereRaw('email = ?',[$email])
        ->where('status', '0')
        ->get();

        if(empty($user[0]->email)) {
            session(['mailmsg'=>'メールアドレスが一致しません。']);
            return $result;
        }

        //パスワードの照会
        if(Hash::check($password,$user[0]->password)){
            //ログイン成功
            session(['login_user'=>$user]);
            $result = true;
            return $result;
        }
        else{

            session(['email'=> $user[0]->email]);
            session(['pwmsg'=>'パスワードが一致しません。']);
            return $result;
        }  
        
    }


     /**
     * ログインしているかどうかチェック
     * @param void
     * @return bool $result
     */

    public function checkLogin() 
    {
       $result = false;
       //セッションにログインユーザが入っていなかったらfalse
       if(session()->has('login_user')) {
            $result = true;
            return $result;
        }else{
            return $result;
        }
    //    if (isset($_SESSION['login_user']['id']) && $_SESSION['login_user']['id'] > 0)
    //    {
    //         return $result = true;
    //    }
    //    return $result;
    }
    
    /**
     * logoutAcc
     *
     * @return void
     */

    public function logoutAcc()
    {
        $_SESSION = array();
        session_destroy();
    }

    public function updateUser($name,$greeting,$nickname,$email,$password,$id){

        $hash = Hash::make($password);
        
        $affected = DB::table('users')
        ->where('id',$id)
        ->update([
            'name' => $name,
            'greeting' => $greeting,
            'nickname' => $nickname,
            'email' => $email,
            'password' => $hash,

        ]);

        return $affected;
        // $sql = "UPDATE users SET name=?, greeting=?, nickname=?, email=?, password=? WHERE id = ?";

        // try{
        //     $sth = $this->dbh->prepare($sql);
        //     $sth ->bindValue(1, $name);
        //     $sth ->bindValue(2, $greeting);
        //     $sth ->bindValue(3, $nickname);
        //     $sth ->bindValue(4, $email);
        //     $sth ->bindValue(5, $password);
        //     $sth ->bindValue(6, $id);

        //     $arr= [];
        //     $arr[] = $name;
        //     $arr[] = $greeting;
        //     $arr[] = $nickname;
        //     $arr[] = $email;
        //     $arr[] = password_hash($password, PASSWORD_DEFAULT);
        //     $arr[] = $id;
        //     $result = $sth->execute($arr);
        //     return $result;
        // }catch(\Exception $e){
        //     echo $e->getMessage();
        //     return $result;
        // }
    }

    /**
     * ユーザー詳細を取得する
     * (users)
     */
    public function getUsers($id)
    {

        $result = False;

        $user =
        DB::table('users')
        ->select('*')
        ->from('users')
        ->whereRaw('id = ?',[$id])
        ->get();
        // $sql = "SELECT * FROM users WHERE id = ?";

        return $user;
    }

    public function updatePassword($password,$email)
    {

        $hash = Hash::make($password);

        $result = DB::table('users')
        ->where('email',$email)
        ->update(['password' => $hash]);
        // $sql = "UPDATE users SET `password` = ? WHERE `email` = ? ";

        return $result;
    }

    public function admingetUser()
    {
        $user =
        DB::table('users')
        ->select(
            'id','name','nickname','email','password','role'
        )
        ->where('status','=','0')
        ->get();

        return $user;
        // $sql = "SELECT id,name,nickname,email,password,role FROM `users` WHERE status = 0";

        // try{
        //     $sth = $this->dbh->prepare($sql);
        //     $result = $sth->execute();
        //     $user = $sth->fetchAll();
        //     return $user;
        // }catch(\Exception $e){
        //     echo $e->getMessage();
        //     return $result;
        // }
    }

    public function admindeleteUser($id)
    {
        $delete =
        DB::table('users')
        ->whereRaw('id = ?',[$id])
        ->delete();

        return $delete;

        // $sql = "DELETE FROM `users` WHERE id = ?";
        // try{
        //     $sth = $this->dbh->prepare($sql);
        //     $sth ->bindValue(1, $id);
        //     $result = $sth->execute();
        //     $user = $sth->fetchAll();
        //     return $result;
        // }catch(\Exception $e){
        //     echo $e->getMessage();
        //     return $result;
        // }
    }

    public function del_flg($id)
    {
        $del_flg = 
        DB::table('users')
        ->whereRaw('id = ?',[$id])
        ->update([
            'status' => 1,
        ]);
        session()->flush();

        return $del_flg;
    }
}
