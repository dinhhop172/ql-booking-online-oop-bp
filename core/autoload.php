<?php
    $autoloadControllerAdmin = function ($className) {
        $path = 'controllers/admin/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };
    $autoloadControllerAuth = function ($className) {
        $path = 'controllers/auth/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };
    $autoloadControllerUser = function ($className) {
        $path = 'controllers/home/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };
    $autoloadModel = function ($className) {
        $path = 'models/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };

    $autoloadModelAdmin = function ($className) {
        $path = 'models/admin/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };
    $autoloadModelAuth = function ($className) {
        $path = 'models/auth/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };
    $autoloadModelUser = function ($className) {
        $path = 'models/home/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };
    $autoloadHelpers = function ($className) {
        $path = 'helpers/' . $className . '.php';
        if(file_exists($path)) {
            include_once $path;
        }
        
    };

    spl_autoload_register($autoloadControllerAdmin);
    spl_autoload_register($autoloadControllerAuth);
    spl_autoload_register($autoloadControllerUser);
    spl_autoload_register($autoloadModel);
    spl_autoload_register($autoloadModelAdmin);
    spl_autoload_register($autoloadModelAuth);
    spl_autoload_register($autoloadModelUser);
    spl_autoload_register($autoloadHelpers);
?>