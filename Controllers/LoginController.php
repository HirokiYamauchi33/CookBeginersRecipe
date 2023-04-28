<?php
require_once(ROOT_PATH .'/Models/UserLogic.php');

class LoginController {
    private $UserLogic; //UserLogic モデル

    public function __construct() {
        // リクエストパラメータの取得
        // $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        // モデルオブジェクトの生成
        $this->UserLogic = new UserLogic();
    }

    public function newUser()
    {
        if(empty($_POST)) {
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit;
        }

        $user = $this->UserLogic->createUser($_POST);
        $params = [
            'user' => $user
        ];
        // print_r($_POST);
    }
    
    public function login()
    {
        $user = $this->UserLogic->loginUser($_POST['email'], $_POST['password']);
        return $user;
    }

    public function verifyLogin()
    {
        $user = $this->UserLogic->checkLogin();
        return $user;
    }

    public function logout()
    {
        $user = $this->UserLogic->logoutAcc();
    }

    public function del_flg()
    {
        $user = $this->UserLogic->del_flg();
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

    public function getUsers($id){
        $user = $this->UserLogic->getUsers($id);
        return $user;
    }

    public function updatePassword($password,$email){
        $user = $this->UserLogic->updatePassword($password,$email);
        return $user;
    }

    public function admingetUser(){
        $user = $this->UserLogic->admingetUser();
        return $user;
    }

    public function admindeleteUser($id){
        $user = $this->UserLogic->admindeleteUser($id);
        return $user;
    }
}

?>