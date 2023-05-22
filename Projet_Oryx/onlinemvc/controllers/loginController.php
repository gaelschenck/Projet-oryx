<?php

class loginController {

    protected $oLoginModel;

    public function __construct(){
        $this->oLoginModel = new LoginModel;
    }

    public function loginIndex(){
        //  $this->oLoginModel = new loginModel();

        if(isset($_POST['login'])) {
            $uid = $this->oLoginModel->existUser($_POST);
// var_dump($uid);
            if ($uid > 0){
                $_SESSION['user_id'] = $uid;
                header('location:../onlinemvc/chat/chatIndex/1');
            }else{
                echo '<script>alert ("erratum"); </script>';
            }
        }else{
            
        }
        
        require_once(ROOT . 'views/login/loginView.php');
    }

    public function signup(){
        // error_log(print_r($_POST, 1));
        if(isset($_POST['submit']))
        
        {
            // error_log(print_r($_POST, 1));
            $userId = $this->oLoginModel->createUser($_POST);

            if(!empty($userId)){
            header('location:../login/loginIndex');
            }
        }else {

        }
        require_once(ROOT . 'views/login/signupView.php');
    }

    public function changePassword(){

        if(isset($_POST['change'])) {
        $pwd = $this->oLoginModel->forgotPassword($_POST);
            if(!empty($pwd)){
                header('location:../login/loginIndex');
            }
        }else{

        }
        require_once(ROOT . '/views/login/forgotPasswordView.php');
    }
}

?>