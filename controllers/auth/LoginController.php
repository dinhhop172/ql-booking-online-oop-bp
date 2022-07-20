<?php
    class LoginController extends Controller{
        
        private $modelLogin;
        private $mail;

        public function __construct()
        {
            $this->modelLogin = $this->model('LoginModel');
            $this->mail = $this->controller('Sendmail');
        }

        public function index()
        {
            return $this->view('auth/login/index');
        }

        public function subLogin()
        {
            if(isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])){
                $email = isset($_POST['email']) ? $this->check_input($_POST['email']) : '';
                $pass = isset($_POST['password']) ? $this->check_input($_POST['password']) : '';
                $loggerUser = $this->modelLogin->check_user_exist($email);
                
                if($this->modelLogin->check_user_exist($email) != null){
                    if(password_verify($pass, $loggerUser['password'])){
                        if(($loggerUser['roles'] == 'user') && $loggerUser['email_verified_at'] == null){
                            $_SESSION['user'] = $loggerUser;
                            $_SESSION['verify_email'] = "<script>alert('Please verify your email first')</script>";
                            return header('Location: ../../index.php');
                        }
                        if(($loggerUser['roles'] == 'user') && $loggerUser['email_verified_at'] != null){
                            $_SESSION['user'] = $loggerUser;
                            return header('Location: ?c=home');
                        }
                        if($loggerUser['roles'] == 'staff'){
                            $_SESSION['staff'] = $loggerUser;
                            return header('Location: ../../views/admin/dashboard/index.php');
                        }
                        if($loggerUser['roles'] == 'admin'){
                            $_SESSION['admin'] = $loggerUser;
                            $verification_code = 'admin';
                            $_COOKIE[$verification_code] = substr(number_format(time() * rand(),0,'',''),0,6);
                            $data['verification_code'] = $_COOKIE[$verification_code];
                            $data['email'] = $email;
                            $body = '<p>Your verification code is: <b style="font-size: 30px">'.$data['verification_code'].'</b></p>';
        
                            // if($this->model->set_verify_code_admin($data)){
                            //     $this->mail->sendtoemail($email, $loggerUser['username'], $body);
                            //     return header("Location: email_verification_admin.php?email=".$data['email']);
                            // }
                        }
                    }else{
                        $_SESSION['error'] = 'Mat khau khong dung';
                        $_SESSION['email'] = $email;
                        return header('Location: ../../views/auth/login.php');
                    }
                }else{
                    $_SESSION['error'] = 'Tài khoản hoac mat khau không chinh xac';
                    return header('Location: ../../views/auth/login.php');
                }
            }else{
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
                return header('Location: ../../views/auth/login.php');
            }
        }

    }
?>