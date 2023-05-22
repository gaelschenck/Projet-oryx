<?php
class loginModel extends Model{

    protected $dbh;

    public function __construct() {
        parent::__construct();
            $this->dbh = $this->getConnexion();
            }
    
    public function existUser($data){

        $pseudo = $this->valid_donnees($data['pseudo']);
        $pwd = $this->valid_donnees($data['password']);
        $password = password_hash($pwd , PASSWORD_DEFAULT);
        if (!empty($pseudo)
        && strlen($pseudo) <= 50
        && preg_match("#^[-0-9a-zA-Z.+_@]{3,}$#",$pseudo)
        &&!empty($pwd)
        && strlen($pwd) <= 150
        && preg_match("#^[-0-9a-zA-Z.+_@]{3,}$#",$pwd)){

           

        $sql = "SELECT * FROM users WHERE user_name =:user_name ";
        $query=$this->dbh->prepare($sql);
        $query->bindParam(':user_name', $pseudo, PDO::PARAM_STR);
        // $query->bindParam(':user_password', $password, PDO::PARAM_STR);
        // $query->bindParam(':user_password', $password, PDO::PARAM_STR);
        $query->execute();
        $result= $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_name'] = $result['user_name'];
        // var_dump($pwd);
        // var_dump($result);
        // var_dump(($result['user_password']));
        // var_dump($password);



        if(!empty($result) && password_verify($data['password'], $result['user_password'])){
            return $result['user_id'];
        }else{
            echo '<script>alert ("Utilisateur ou mot de passe inconnu"); </script>';
        }
    }
}

    public function createUser(){
           
        /*if ($_POST['vercode'] != $_SESSION['vercode'])
        {
            echo '<script>alert ("Wrong Lever !"); </script>';
            exit();
        }*/
        // error_log(' 1 coucou');
            $name = $this->valid_donnees($_POST['pseudo']);
            $mail = $this->valid_donnees($_POST['email']);
            $mdp = $this->valid_donnees($_POST['password']);
            if (!empty($name)
                && strlen($name) <= 50
                && preg_match("#^[-0-9a-zA-Z.+_@]{3,}$#",$name)
                && !empty($mail)
                && strlen($mail) <= 255
                && preg_match("#^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}$#",$mail)
                && !empty($mdp)
                && strlen($mdp) <= 150
                && preg_match("#^[-0-9a-zA-Z.+_@]{3,}$#",$mdp))
        {

            // error_log(' 2 coucou');
            $password = password_hash($mdp , PASSWORD_DEFAULT);
            $query = $this->dbh->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email, :user_password)");
            // On éxecute la requete
            $query->bindParam(':user_name', $name, PDO::PARAM_STR);
            $query->bindParam(':user_email', $mail, PDO::PARAM_STR);
            $query->bindParam(':user_password', $password, PDO::PARAM_STR);
            $query->execute(); 
            $result= $query->fetch(PDO::FETCH_ASSOC);


        if(!empty($result)){
            require_once(ROOT . 'views/login/loginView.php');
        }else{
            echo '<script>alert ("Utilisateur ou mot de passe inconnu"); </script>';
        }
        }
        
    }

    public function forgotPassword(){

        $mail = $this->valid_donnees($_POST['email']);
        $mdp = $this->valid_donnees($_POST['password']);
        $password = password_hash($mdp, PASSWORD_DEFAULT);
        if(!empty($mail)
            && strlen($mail) <= 255
            && preg_match("#^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}$#",$mail)
            && !empty($password)
            && strlen($password) <= 150
            && preg_match("#^[-0-9a-zA-Z.+_@]{3,}$#",$password))
            {
       
            
            $sql = "SELECT user_email FROM users WHERE user_email=:user_email";
            $query=$this->dbh->prepare($sql);
            $query->bindParam(':user_email', $mail, PDO::PARAM_STR);
            $query->execute();
            $result= $query->fetch(PDO::FETCH_OBJ);
            // Si le resultat de recherche n'est pas vide
            if($result){
           
   
                // On met a jour la table tblreaders avec le nouveau mot de passe
                $sql = "UPDATE users SET Password=:password WHERE user_email=:user_email";
                $query = $this->dbh->prepare($sql);
                $query->bindParam(':user_email', $mail, PDO::PARAM_STR);
                $query->execute();
                echo '<script>alert ("mot de passe modifié"); </script>';
                //header ('location:index.php');
                
            }else{
                echo '<script>alert ("Le mail n\'/existe pas"); </script>';
            }
        }
    }
}
?>