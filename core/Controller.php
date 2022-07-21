<?php

    class Controller {

        public function view($file, $data=[])
        {
            $path = 'views/'.$file.'.php';
            if(file_exists($path)){
                ob_start();
                require_once "$path";
                $content = ob_get_clean();
                if(strpos($path, 'admin')){
                    require_once 'views/layouts/admin.php';
                } elseif(strpos($path, 'home')) {
                    require_once 'views/layouts/home.php';
                }elseif(strpos($path, 'auth')){
                    require_once 'views/layouts/login_register.php';
                }
            }else{
                die('file not found');
            }
        }

        public function viewNomal($file, $data = []){
            $path = 'views/'.$file.'.php';
            if(file_exists($path)){
                require_once "$path";
            }
        }

        public function check_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function showMessage($type, $message){
            return "
                    <div class='alert alert-".$type." alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong class='text-center'>".$message."</strong>
                    </div>
                    ";
        }

        public function model($model)
        {
            $path = 'models/'.$model.'.php';
            if(file_exists($path)){
                require_once $path;
                return new $model;
            }
        }

        public function contr($controller)
        {
            $path = 'controllers/auth/'.$controller.'.php';
            if(file_exists($path)){
                require_once "$path";
                return new $controller;
            }
        }
    }

?>