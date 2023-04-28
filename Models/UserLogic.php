<?php
require_once(ROOT_PATH .'/Models/Db.php');


class UserLogic extends Db {
    private $table = "users";
    public function __construct($dbh = null){
    parent::__construct($dbh); 
    }

    /**
     * ユーザー情報をDBに登録する
     */
    public function createUser($userData){
        $sql = 'INSERT INTO users (name, email,password,nickname) VALUES (?,?,?,?)';

        $sth = $this->dbh->prepare($sql);
        $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
        $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
        $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
        $sth ->bindParam(":nickname", $_POST['nickname'], PDO::PARAM_STR);
        $arr= [];
        $arr[] = $userData['name'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);
        $arr[] = $userData['nickname'];
        // print_r($arr);
        
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($arr);
        return $result;
    }

    public function loginUser($email, $password)
    {
        $result = false;
        //ユーザデータをemailから検索
        $sql = 'SELECT * FROM users WHERE email = ? AND status = 0';

        $arr= [];
        $arr[] = $email;
       
        // print_r($arr);
        $sth = $this->dbh->prepare($sql);
        $sth->execute($arr);
        //SQLの結果を返す
        $user = $sth->fetch();

        if(!$user) {
            $_SESSION['msg'] = 'メールアドレスが一致しません。';
            return $result;
        }

        //パスワードの照会
        if(password_verify($password,$user['password'])){
            //ログイン成功
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }
        elseif(!password_verify($password,$user['password'])){
            $_SESSION['msg'] = 'パスワードが一致しません。';
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
       if (isset($_SESSION['login_user']['id']) && $_SESSION['login_user']['id'] > 0)
       {
            return $result = true;
       }
       return $result;
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


    public function del_flg()
    {
        $sql = 'UPDATE users SET status = 1 WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $_SESSION['login_user']['id']);
        $sth->execute();

        $_SESSION = array();
        session_destroy();
    }

    public function updateUser($name,$greeting,$nickname,$email,$password,$id){

        $result = False;

        $sql = "UPDATE users SET name=?, greeting=?, nickname=?, email=?, password=? WHERE id = ?";

        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $name);
            $sth ->bindValue(2, $greeting);
            $sth ->bindValue(3, $nickname);
            $sth ->bindValue(4, $email);
            $sth ->bindValue(5, $password);
            $sth ->bindValue(6, $id);

            $arr= [];
            $arr[] = $name;
            $arr[] = $greeting;
            $arr[] = $nickname;
            $arr[] = $email;
            $arr[] = password_hash($password, PASSWORD_DEFAULT);
            $arr[] = $id;
            $result = $sth->execute($arr);
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    /**
     * ユーザー詳細を取得する
     * (users)
     */
    public function getUsers($id)
    {
        $result = False;
        $sql = "SELECT * FROM users WHERE id = ?";

        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $id);
            $result = $sth->execute();
            $user = $sth->fetchAll();
            return $user;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    public function updatePassword($password,$email)
    {
        $result = False;
        $sql = "UPDATE users SET `password` = ? WHERE `email` = ? ";

        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $password);
            $sth ->bindValue(2, $email);

            $arr= [];
            $arr[] = password_hash($password, PASSWORD_DEFAULT);
            $arr[] = $email;
            $result = $sth->execute($arr);
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    public function admingetUser()
    {
        $sql = "SELECT id,name,nickname,email,password,role FROM `users` WHERE status = 0";

        try{
            $sth = $this->dbh->prepare($sql);
            $result = $sth->execute();
            $user = $sth->fetchAll();
            return $user;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }

    public function admindeleteUser($id)
    {
        $sql = "DELETE FROM `users` WHERE id = ?";

        try{
            $sth = $this->dbh->prepare($sql);
            $sth ->bindValue(1, $id);
            $result = $sth->execute();
            $user = $sth->fetchAll();
            return $result;
        }catch(\Exception $e){
            echo $e->getMessage();
            return $result;
        }
    }
}

?>
