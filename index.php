<?php session_start();
    require_once 'core/autoload.php';
    require_once 'core/Controller.php';
    require_once 'core/Database.php';

    $controller = isset($_GET['c']) ? $_GET['c'] : $_GET['c'] = 'home';
    $action = isset($_GET['a']) ? $_GET['a'] : $_GET['a'] = 'index';
    $arrayController = ['home', 'dashboard', 'admin', 'login', 'register', 'sendmail'];

    if(!empty($controller) && !empty($action)) {
        if(in_array($controller, $arrayController)){
            $controller = ucfirst($controller) . 'Controller';
            if(method_exists($controller, $action)){
                call_user_func([new $controller(), $action]);
            }else{
                echo 'method not found';
                var_dump($controller, $action);
            }
        }else{
            echo 'controller not found';
        }
    }else{
        die('controller or action not found');
    }
?>
