<?php

session_start();
// session_destroy();
// var_dump($_SESSION);
function loadClass($class){

    if (strpos($class, "Controller" )!== FALSE){
        require 'controllers/' . $class . '.php';
    }
    if (strpos($class, "Model" )!== FALSE){
        require 'models/' . $class . '.php';
    }
}
spl_autoload_register('loadClass');

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

// error_log('cucaracha' .print_r( $_GET, 1));

//require_once(ROOT.'models/loginModel.php');
//require_once(ROOT.'controllers/loginController.php');
// if (!empty($_GET)){
$params = explode('/',$_GET['action']);

if (isset($params[1])) {
    $controller = $params[0] . "Controller";
    $method = $params[1];
    
// var_dump($params);
    $oController = new $controller();

    error_log("Appel de ".$controller."::".$method);

    if(method_exists($oController,$method)== TRUE){
        $oController->$method();
    }else{
        http_response_code(404);
        echo "La page recherchée n'existe pas...";
    }
// }
}else{
    $oController = new loginController();
    $oController->loginIndex();
}
?>