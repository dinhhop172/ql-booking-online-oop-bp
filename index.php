<?php session_start();
    require_once 'core/Session.php';
    require_once 'core/autoload.php';
    require_once 'core/Controller.php';
    require_once 'core/Database.php';
    require 'vendor/autoload.php';

    $controller = !empty($_GET['c']) ? $_GET['c'] : $_GET['c'] = 'home';
    $action = !empty($_GET['a']) ? $_GET['a'] : $_GET['a'] = 'index';
    $arrayController = ['home', 'dashboard', 'admin', 'login', 'register', 'verify', 'booking', 'user'];

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
